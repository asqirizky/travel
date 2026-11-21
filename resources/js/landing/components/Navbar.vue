<template>
    <div class="navbar">
        <header class="site-header" :class="{ scrolled, open: menuOpen }">
            <Link
                href="/"
                class="logo"
                aria-label="Indonesia Culture Trip - Home"
                @click="closeMenu"
            >
                <span class="logo-mark" aria-hidden="true">
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M22 2 11 13" />
                        <path d="M22 2 15 22l-4-9-9-4Z" />
                    </svg>
                </span>
                <span class="logo-text">
                    Indonesia <span>Culture</span> Trip
                </span>
            </Link>

            <nav
                id="primary-navigation"
                :class="['navigation', { open: menuOpen }]"
                aria-label="Main navigation"
            >
                <Link
                    v-for="link in links"
                    :key="link.href"
                    :href="link.href"
                    :class="{ active: isActive(link.href) }"
                    @click="closeMenu"
                >
                    {{ link.label }}
                </Link>
            </nav>

            <button
                type="button"
                class="menu-toggle"
                :class="{ open: menuOpen }"
                :aria-expanded="menuOpen"
                aria-controls="primary-navigation"
                :aria-label="
                    menuOpen ? 'Close navigation menu' : 'Open navigation menu'
                "
                @click="toggleMenu"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>
        </header>

        <Transition name="nav-fade">
            <div v-if="menuOpen" class="menu-backdrop" @click="closeMenu"></div>
        </Transition>
    </div>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref, watch } from 'vue';

const page = usePage();

const menuOpen = ref(false);
const scrolled = ref(false);

const links = [
    { href: '/', label: 'Home' },
    { href: '/about', label: 'About' },
    { href: '/service', label: 'Service' },
    { href: '/contact', label: 'Contact' },
];

const isActive = (href: string): boolean =>
    href === '/' ? page.url === '/' : page.url.startsWith(href);

const updateScrolled = (): void => {
    scrolled.value = window.scrollY > 24;
};

const toggleMenu = (): void => {
    menuOpen.value = !menuOpen.value;
};

const closeMenu = (): void => {
    menuOpen.value = false;
};

const handleKeydown = (event: KeyboardEvent): void => {
    if (event.key === 'Escape') {
        closeMenu();
    }
};

const handleResize = (): void => {
    if (window.innerWidth > 768) {
        closeMenu();
    }
};

watch(menuOpen, (open) => {
    document.body.style.overflow = open ? 'hidden' : '';
});

watch(
    () => page.url,
    () => closeMenu(),
);

onMounted(() => {
    updateScrolled();
    window.addEventListener('scroll', updateScrolled, { passive: true });
    window.addEventListener('keydown', handleKeydown);
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('scroll', updateScrolled);
    window.removeEventListener('keydown', handleKeydown);
    window.removeEventListener('resize', handleResize);
    document.body.style.overflow = '';
});
</script>
