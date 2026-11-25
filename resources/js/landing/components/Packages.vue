<template>
    <section id="packages" class="pricing">
        <div class="container">
            <h2 class="section-title">Start Your Journey</h2>
            <p class="section-subtitle">Choose your dream destination</p>

            <div class="wrapper">
                <!-- Button Prev -->
                <button
                    class="nav prev"
                    @click="scroll(-1)"
                    aria-label="Previous"
                >
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>

                <!-- Track / Container Card -->
                <div class="track" ref="track">
                    <div v-for="item in packages" :key="item.id" class="card">
                        <!-- Header Gambar -->
                        <div
                            class="card-image"
                            :style="{
                                backgroundImage: `url(${item.thumbnail || 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=600&q=80'})`,
                            }"
                        >
                            <div class="card-overlay"></div>

                            <!-- Badge Durasi -->
                            <div class="card-badge">
                                {{ item.duration_days }}D
                                {{ item.duration_nights }}N
                            </div>

                            <!-- Badge Harga Format Rupiah -->
                            <!-- <div class="card-price">
                <span class="amount">{{ formatRupiah(item.price) }}</span>
              </div> -->
                        </div>

                        <!-- Body Card -->
                        <div class="card-body">
                            <div class="card-location">{{ item.location }}</div>
                            <h3 class="card-title">{{ item.name_package }}</h3>
                            <p class="card-desc">
                                {{ item.short_description }}
                            </p>

                            <!-- Meta Icons (Durasi & Kapasitas) -->
                            <div class="card-meta">
                                <span class="meta-item">
                                    <svg
                                        width="16"
                                        height="16"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    {{ item.duration_days }} Days
                                    {{ item.duration_nights }} Nights
                                </span>
                            </div>

                            <a :href="`/packages/${item.slug}`" class="btn">
                                Lihat Detail Paket
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Button Next -->
                <button class="nav next" @click="scroll(1)" aria-label="Next">
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
            </div>

            <!-- State Jika Data Kosong -->
            <div
                v-if="!packages || packages.length === 0"
                class="py-12 text-center text-slate-500"
            >
                There are currently no active tour packages.
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import type { Package } from '@/types';

withDefaults(
    defineProps<{
        packages?: Package[];
    }>(),
    {
        packages: () => [],
    },
);

const track = ref<HTMLElement | null>(null);

function scroll(dir: number) {
    if (!track.value) return;

    const cardElement = track.value.querySelector(
        '.card',
    ) as HTMLElement | null;
    const w = cardElement?.offsetWidth || 300;
    track.value.scrollBy({ left: dir * (w + 24), behavior: 'smooth' });
}

const formatRupiah = (val: number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(val);
};
</script>

<style scoped>
.pricing {
    position: relative;
    scroll-margin-top: 80px;
    padding: 100px 20px;
    background: #ffffff;
    overflow: hidden;
}

.container {
    position: relative;
    z-index: 1;
    max-width: 1100px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    font-size: 2.5em;
    color: #0f172a;
    margin-bottom: 8px;
    font-weight: 800;
}

.section-subtitle {
    text-align: center;
    font-size: 1.1em;
    color: #64748b;
    margin-bottom: 60px;
}

.wrapper {
    position: relative;
}

.track {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}

.track::-webkit-scrollbar {
    display: none;
}

.card {
    flex: 0 0 calc((100% - 48px) / 3);
    min-width: 0;
    scroll-snap-align: start;
    background: rgba(248, 250, 252, 0.6);
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 20px;
    overflow: hidden;
    transition:
        transform 0.4s ease,
        box-shadow 0.4s ease,
        border-color 0.4s ease;
    backdrop-filter: blur(8px);
    display: flex;
    flex-direction: column;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    border-color: rgba(59, 130, 246, 0.3);
}

.card-image {
    position: relative;
    height: 240px;
    background-size: cover;
    background-position: center;
}

.card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.35));
}

.card-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    background: rgba(15, 23, 42, 0.35);
    backdrop-filter: blur(8px);
    color: #0f172a;
    font-size: 0.75em;
    font-weight: 500;
    padding: 5px 14px;
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.card-price {
    position: absolute;
    bottom: 16px;
    right: 16px;
    display: flex;
    align-items: baseline;
    gap: 2px;
    background: rgba(15, 23, 42, 0.35);
    backdrop-filter: blur(8px);
    padding: 6px 16px;
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.amount {
    font-size: 1.1em;
    font-weight: 700;
    color: #0f172a;
    line-height: 1;
}

.card-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.card-location {
    font-size: 0.8em;
    color: #3b82f6;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: 600;
    margin-bottom: 4px;
}

.card-title {
    font-size: 1.3em;
    color: #0f172a;
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1.3;
}

.card-desc {
    font-size: 0.85em;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 18px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-meta {
    display: flex;
    gap: 16px;
    margin-bottom: 20px;
    margin-top: auto;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    font-size: 0.82em;
}

.meta-item svg {
    color: #3b82f6;
    flex-shrink: 0;
}

.btn {
    width: 100%;
    padding: 14px;
    border: 1px solid rgba(59, 130, 246, 0.4);
    border-radius: 12px;
    background: transparent;
    color: #3b82f6;
    font-size: 0.9em;
    font-weight: 600;
    cursor: pointer;
    transition:
        background 0.3s ease,
        color 0.3s ease,
        border-color 0.3s ease;
    font-family: inherit;
    text-align: center;
    text-decoration: none;
    display: block;
}

.btn:hover {
    background: #3b82f6;
    color: #ffffff;
    border-color: #3b82f6;
}

.nav {
    position: absolute;
    top: 50%;
    z-index: 10;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(15, 23, 42, 0.25);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 50%;
    color: #3b82f6;
    cursor: pointer;
    transition:
        background 0.3s ease,
        color 0.3s ease,
        border-color 0.3s ease;
    backdrop-filter: blur(8px);
}

.nav:hover {
    background: #3b82f6;
    color: #ffffff;
    border-color: #3b82f6;
}

.nav.prev {
    left: -22px;
}

.nav.next {
    right: -22px;
}

@media (max-width: 960px) {
    .card {
        flex: 0 0 calc((100% - 24px) / 2);
    }

    .section-title {
        font-size: 2em;
    }

    .card-image {
        height: 200px;
    }
}

@media (max-width: 768px) {
    .nav {
        display: none;
    }
}

@media (max-width: 640px) {
    .pricing {
        padding: 60px 16px;
    }

    .section-title {
        font-size: 1.8em;
    }

    .card {
        flex: 0 0 100%;
    }

    .track {
        gap: 0;
    }

    .card-body {
        padding: 20px;
    }

    .card-image {
        height: 180px;
    }
}
</style>
