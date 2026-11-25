<template>
    <section class="why-us">
        <div class="container">
            <div class="head">
                <span class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Why Choose Us
                </span>
                <h2 class="section-title">Why Travel With Us?</h2>
                <p class="section-subtitle">
                    From volcanic sunrises to island escapes — every moment is
                    curated for you
                </p>
                <a href="#packages" class="head-cta">
                    Explore Tour Packages
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="showcase">
                <aside class="visual">
                    <img
                        src="/landing_hero/bromo.jpg"
                        alt="Mount Bromo at sunrise"
                        loading="lazy"
                    />
                    <div class="visual-overlay"></div>

                    <span class="visual-badge">
                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2Z"
                            />
                        </svg>
                        Guest Favorite
                    </span>

                    <div class="visual-caption">
                        <span class="caption-kicker">Featured Experience</span>
                        <h3>Bromo Sunrise Escape</h3>
                        <p>
                            Ride before dawn, catch first light above the
                            clouds, and cross the Sea of Sand.
                        </p>
                        <div class="caption-meta">
                            <span class="chip">3D2N</span>
                            <span class="chip">East Java</span>
                        </div>
                    </div>
                </aside>

                <div class="features">
                    <article
                        v-for="(item, index) in items"
                        :key="item.title"
                        class="card"
                    >
                        <span class="card-index">{{
                            String(index + 1).padStart(2, '0')
                        }}</span>
                        <div class="icon" v-html="item.icon"></div>
                        <span class="card-category">{{ item.category }}</span>
                        <h3>{{ item.title }}</h3>
                        <p>{{ item.desc }}</p>
                        <div class="card-meta">
                            <svg
                                width="14"
                                height="14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"
                                />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ item.meta }}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
interface Experience {
    icon: string;
    category: string;
    title: string;
    desc: string;
    meta: string;
}

const items: Experience[] = [
    {
        icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m8 3 4 8 5-5 5 15H2L8 3Z"/></svg>',
        category: 'Nature',
        title: 'Volcano Sunrises',
        desc: 'Chase first light over Bromo and Ijen with guides who know every trail.',
        meta: 'Bromo • Ijen',
    },
    {
        icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 18H2a4 4 0 0 0 4 4h12a4 4 0 0 0 4-4Z"/><path d="M21 14 10 2 3 14h18Z"/><path d="M10 2v16"/></svg>',
        category: 'Island',
        title: 'Island Escapes',
        desc: 'Hop between turquoise bays, hidden beaches, and slow island days.',
        meta: 'Bali • Raja Ampat',
    },
    {
        icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="22" y2="22"/><line x1="6" x2="6" y1="18" y2="11"/><line x1="10" x2="10" y1="18" y2="11"/><line x1="14" x2="14" y1="18" y2="11"/><line x1="18" x2="18" y1="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>',
        category: 'Culture',
        title: 'Living Culture',
        desc: 'Walk through temples, villages, and traditions that are still alive today.',
        meta: 'Yogyakarta • Borobudur',
    },
    {
        icon: '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/></svg>',
        category: 'Culinary',
        title: 'Local Flavors',
        desc: 'Taste your way through night markets, warungs, and home kitchens.',
        meta: 'Surabaya • Malang',
    },
];
</script>

<style scoped>
.why-us {
    position: relative;
    isolation: isolate;
    padding: 120px 20px;
    background-color: #101018;
    background-image:
        radial-gradient(
            ellipse at 12% 0%,
            rgba(147, 197, 253, 0.2),
            transparent 55%
        ),
        radial-gradient(
            ellipse at 88% 100%,
            rgba(37, 99, 235, 0.14),
            transparent 55%
        ),
        linear-gradient(180deg, rgba(10, 10, 16, 0.72), rgba(10, 10, 16, 0.86)),
        url('/landing_hero/grandrung.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    overflow: hidden;
}

.why-us::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: -1;
    background: radial-gradient(
        ellipse at center,
        transparent 42%,
        rgba(9, 9, 13, 0.5) 100%
    );
    pointer-events: none;
}

.container {
    position: relative;
    z-index: 1;
    max-width: 1080px;
    margin: 0 auto;
}

.head {
    max-width: 620px;
    margin: 0 auto 60px;
    text-align: center;
}

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 22px;
    padding: 7px 16px;
    border-radius: 999px;
    background: rgba(147, 197, 253, 0.1);
    border: 1px solid rgba(147, 197, 253, 0.22);
    color: #bfdbfe;
    font-size: 0.76em;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
}

.eyebrow-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #93c5fd;
    box-shadow: 0 0 10px rgba(147, 197, 253, 0.9);
}

.section-title {
    font-size: clamp(2em, 4vw, 3.2em);
    font-weight: 700;
    line-height: 1.12;
    letter-spacing: -1px;
    color: #ffffff;
    margin: 0 0 14px;
    background: linear-gradient(100deg, #ffffff 25%, #bfdbfe 62%, #bfdbfe);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.section-title::after {
    content: '';
    display: block;
    width: 68px;
    height: 3px;
    margin: 20px auto 0;
    border-radius: 999px;
    background: linear-gradient(90deg, #93c5fd, #bfdbfe);
}

.section-subtitle {
    font-size: 1.05em;
    line-height: 1.7;
    color: #9ca3af;
    margin: 0 0 28px;
}

.head-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 26px;
    border-radius: 999px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #ffffff;
    font-size: 0.92em;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 14px 30px rgba(59, 130, 246, 0.35);
    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;
}

.head-cta span {
    transition: transform 0.3s ease;
}

.head-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 36px rgba(37, 99, 235, 0.45);
}

.head-cta:hover span {
    transform: translateX(4px);
}

.showcase {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 26px;
    align-items: stretch;
}

.visual {
    position: relative;
    isolation: isolate;
    min-height: 540px;
    border-radius: 26px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.45);
}

.visual img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 1s cubic-bezier(0.2, 0.7, 0.2, 1);
}

.visual:hover img {
    transform: scale(1.06);
}

.visual-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(8, 8, 12, 0.05) 0%,
        rgba(8, 8, 12, 0.25) 45%,
        rgba(8, 8, 12, 0.9) 100%
    );
}

.visual-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 15px;
    border-radius: 999px;
    background: rgba(13, 13, 18, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: #ffffff;
    font-size: 0.8em;
    font-weight: 600;
}

.visual-badge svg {
    color: #bfdbfe;
}

.visual-caption {
    position: absolute;
    left: 20px;
    right: 20px;
    bottom: 20px;
    z-index: 2;
    padding: 22px;
    border-radius: 18px;
    background: rgba(13, 13, 18, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(14px);
}

.caption-kicker {
    font-size: 0.72em;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: #bfdbfe;
}

.visual-caption h3 {
    margin: 8px 0 6px;
    font-size: 1.35em;
    font-weight: 600;
    color: #ffffff;
}

.visual-caption p {
    margin: 0;
    font-size: 0.88em;
    line-height: 1.6;
    color: #d1d5db;
}

.caption-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 14px;
}

.chip {
    padding: 5px 12px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.14);
    font-size: 0.72em;
    font-weight: 500;
    letter-spacing: 0.5px;
    color: #e5e7eb;
}

.features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    padding: 28px 24px;
    border-radius: 22px;
    background: linear-gradient(
        160deg,
        rgba(32, 32, 44, 0.78),
        rgba(17, 17, 24, 0.72)
    );
    border: 1px solid rgba(147, 197, 253, 0.14);
    backdrop-filter: blur(10px);
    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.04),
        0 14px 30px rgba(0, 0, 0, 0.25);
    transition:
        transform 0.35s ease,
        border-color 0.35s ease,
        box-shadow 0.35s ease;
}

.card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(
        circle at 20% 0%,
        rgba(147, 197, 253, 0.2),
        transparent 60%
    );
    opacity: 0;
    transition: opacity 0.35s ease;
    pointer-events: none;
}

.card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #93c5fd, #bfdbfe);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s ease;
}

.card:hover {
    transform: translateY(-6px);
    border-color: rgba(147, 197, 253, 0.45);
    box-shadow:
        0 22px 44px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(147, 197, 253, 0.2);
}

.card:hover::before {
    opacity: 1;
}

.card:hover::after {
    transform: scaleX(1);
}

.card-index {
    position: absolute;
    top: 18px;
    right: 22px;
    font-size: 1.6em;
    font-weight: 800;
    letter-spacing: -1px;
    color: rgba(147, 197, 253, 0.16);
}

.icon {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    margin-bottom: 18px;
    border-radius: 15px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #ffffff;
    box-shadow: 0 10px 24px rgba(59, 130, 246, 0.35);
    transition:
        transform 0.35s ease,
        box-shadow 0.35s ease;
}

.card:hover .icon {
    transform: rotate(-5deg) scale(1.06);
    box-shadow: 0 14px 30px rgba(37, 99, 235, 0.4);
}

.card-category {
    position: relative;
    z-index: 1;
    margin-bottom: 6px;
    font-size: 0.68em;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: #bfdbfe;
}

.card h3 {
    position: relative;
    z-index: 1;
    margin: 0 0 8px;
    font-size: 1.1em;
    font-weight: 600;
    color: #ffffff;
}

.card p {
    position: relative;
    z-index: 1;
    margin: 0;
    font-size: 0.9em;
    line-height: 1.65;
    color: #a1a1aa;
}

.card-meta {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: auto;
    padding-top: 16px;
    font-size: 0.78em;
    color: #8f8f9b;
}

.card-meta svg {
    flex-shrink: 0;
    color: #93c5fd;
}

@media (max-width: 960px) {
    .why-us {
        padding: 90px 20px;
    }

    .head {
        margin-bottom: 44px;
    }

    .showcase {
        grid-template-columns: 1fr;
    }

    .visual {
        min-height: 380px;
    }
}

@media (max-width: 640px) {
    .why-us {
        padding: 70px 16px;
    }

    .section-title {
        font-size: 1.9em;
    }

    .section-subtitle {
        font-size: 0.98em;
    }

    .visual {
        min-height: 340px;
    }

    .visual-caption {
        padding: 18px;
    }

    .visual-caption h3 {
        font-size: 1.15em;
    }

    .features {
        grid-template-columns: 1fr;
    }

    .card {
        padding: 24px 20px;
    }
}
</style>
