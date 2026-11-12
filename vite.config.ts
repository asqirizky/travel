import { Buffer } from 'node:buffer';
import { execSync } from 'node:child_process';
import { Features, transform as transformCss } from 'lightningcss';
import postcss from 'postcss';
import type { AtRule, ChildNode } from 'postcss';
import { defineConfig, type Plugin } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import { bunny } from 'laravel-vite-plugin/fonts';

/**
 * Di host, PHP bisa saja tidak ada atau versinya terlalu lama (project butuh 8.3+).
 * Kalau begitu, Wayfinder dijalankan lewat container `app` yang sudah punya PHP 8.4.
 */
function resolveWayfinderCommand(): string {
    try {
        execSync('php -r "exit(PHP_VERSION_ID >= 80300 ? 0 : 1);"', {
            stdio: 'ignore',
        });

        return 'php artisan wayfinder:generate';
    } catch {
        return 'docker compose exec -T app php artisan wayfinder:generate';
    }
}

/**
 * Firefox 89 tidak mendukung cascade layers (`@layer`). Tailwind CSS v4
 * membungkus hampir semua output-nya di dalam `@layer`, sehingga tanpa
 * langkah ini seluruh style diabaikan oleh browser lama.
 *
 * Fungsi ini membuka setiap blok `@layer` dan menyusun ulang aturannya
 * sesuai urutan layer (properties, theme, base, components, utilities),
 * lalu menaruh aturan tanpa layer di akhir agar prioritasnya tetap benar.
 */
function flattenCascadeLayers(css: string): string {
    const root = postcss.parse(css);
    const layerOrder: string[] = [];
    const layerBlocks = new Map<string, AtRule[]>();
    const unlayered: ChildNode[] = [];

    for (const node of [...root.nodes]) {
        if (node.type !== 'atrule' || node.name !== 'layer') {
            unlayered.push(node);
            node.remove();
            continue;
        }

        const name = node.params.trim();

        if (!node.nodes) {
            for (const layerName of name.split(',').map((value) => value.trim()).filter(Boolean)) {
                if (!layerOrder.includes(layerName)) {
                    layerOrder.push(layerName);
                }
            }

            node.remove();
            continue;
        }

        if (name && !layerOrder.includes(name)) {
            layerOrder.push(name);
        }

        const blocks = layerBlocks.get(name) ?? [];
        blocks.push(node);
        layerBlocks.set(name, blocks);
        node.remove();
    }

    for (const name of layerOrder) {
        for (const block of layerBlocks.get(name) ?? []) {
            for (const child of [...(block.nodes ?? [])]) {
                root.append(child);
            }
        }
    }

    for (const [name, blocks] of layerBlocks) {
        if (layerOrder.includes(name)) {
            continue;
        }

        for (const block of blocks) {
            for (const child of [...(block.nodes ?? [])]) {
                root.append(child);
            }
        }
    }

    for (const node of unlayered) {
        root.append(node);
    }

    return root.toString();
}

/**
 * Menurunkan CSS Tailwind v4 (oklch, color-mix, nesting, dll.) ke target
 * Firefox 89. Tanpa ini, banyak deklarasi warna/utility tidak dikenali.
 */
function firefox89Css(): Plugin {
    return {
        name: 'firefox89-css',
        enforce: 'pre',
        transform(code, id) {
            const isCss = /\.css(?:\?.*)?$/.test(id) || id.includes('&lang.css');

            if (!isCss) {
                return;
            }

            const result = transformCss({
                filename: id,
                code: Buffer.from(flattenCascadeLayers(code)),
                targets: { firefox: 89 << 16 },
                drafts: { customMedia: true },
                nonStandard: { deepSelectorCombinator: true },
                include: Features.Nesting | Features.MediaQueries,
                exclude: Features.LogicalProperties | Features.DirSelector | Features.LightDark,
                errorRecovery: true,
            });

            return {
                code: result.code.toString(),
                map: null,
            };
        },
    };
}

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
            protocol: 'ws',
        },
        watch: {
            usePolling: true,
        },
    },

    // Firefox 89 (browser default di mesin ini) belum mendukung private class fields.
    // Vite 8 memakai Oxc/Rolldown, jadi target diatur lewat `oxc` dan `optimizeDeps.rolldownOptions`.
    oxc: {
        target: 'firefox89',
    },
    optimizeDeps: {
        rolldownOptions: {
            transform: {
                target: 'firefox89',
            },
        },
    },
    build: {
        target: 'firefox89',
    },

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        inertia({
            ssr: false,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
        firefox89Css(),
        wayfinder({
            formVariants: true,
            command: resolveWayfinderCommand(),
        }),
    ],
});