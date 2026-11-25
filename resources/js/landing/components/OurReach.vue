<template>
    <section class="our-reach">
        <div class="reach-inner">
            <div class="reach-stack" ref="reachList">
                <article class="reach-item">
                    <div class="reach-body">
                        <span class="body-label">Indonesia</span>
                        <h3 class="body-title">
                            A country of natural wonder and living culture
                        </h3>
                        <p class="body-text">
                            Stretching across more than 17,000 islands,
                            Indonesia holds an extraordinary range of landscapes
                            — volcanic peaks, misty highlands, rainforests, and
                            coral seas. Alongside that beauty live hundreds of
                            cultures, each with its own language, rituals,
                            music, and craft, making every region feel like a
                            different world.
                        </p>
                    </div>

                    <figure class="reach-media">
                        <img
                            src="/landing_hero/ijen.jpg"
                            alt="The turquoise crater lake of Ijen"
                            loading="lazy"
                        />
                        <figcaption class="reach-caption">
                            Ijen, Jawa Timur
                        </figcaption>
                    </figure>
                </article>

                <article class="reach-item is-reversed">
                    <div class="reach-body">
                        <span class="body-label">Why this website</span>
                        <h3 class="body-title">
                            Made to bring Indonesia closer to you
                        </h3>
                        <p class="body-text">
                            This website was built to promote the tourist
                            destinations spread across the archipelago — from
                            celebrated landmarks to quiet places few travelers
                            know. Through curated guides and travel packages, we
                            hope to help more people discover, plan, and
                            experience the beauty of Indonesia.
                        </p>
                    </div>

                    <figure class="reach-media">
                        <img
                            src="/landing_hero/borobudur.jpg"
                            alt="Borobudur temple at sunrise"
                            loading="lazy"
                        />
                        <figcaption class="reach-caption">
                            Borobudur, Jawa Tengah
                        </figcaption>
                    </figure>
                </article>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

const reachList = ref<HTMLElement | null>(null);
let observer: IntersectionObserver | undefined;

onMounted(() => {
    const items = reachList.value?.querySelectorAll<HTMLElement>('.reach-item');

    if (!items?.length) {
        return;
    }

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer?.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -60px 0px' },
    );

    items.forEach((item) => observer?.observe(item));
});

onUnmounted(() => {
    observer?.disconnect();
});
</script>

<style scoped>
.our-reach {
    position: relative;
    overflow: hidden;
    padding: 130px 20px 160px;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 45%, #f8fafc 100%);
}

.our-reach::before {
    content: '';
    position: absolute;
    top: -180px;
    right: -160px;
    width: 560px;
    height: 560px;
    border-radius: 50%;
    background: radial-gradient(
        circle,
        rgba(59, 130, 246, 0.09) 0%,
        transparent 70%
    );
    filter: blur(20px);
    pointer-events: none;
}

.reach-inner {
    position: relative;
    z-index: 1;
    max-width: 1120px;
    margin: 0 auto;
}

.reach-stack {
    display: flex;
    flex-direction: column;
    gap: 110px;
}

.reach-item {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1.05fr);
    align-items: center;
    gap: 72px;
    opacity: 0;
    transform: translateY(24px);
    transition:
        opacity 0.8s ease,
        transform 0.8s ease;
}

.reach-item.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.reach-item.is-reversed {
    grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
}

.reach-item.is-reversed .reach-media {
    order: -1;
}

.reach-media {
    position: relative;
    margin: 0;
    aspect-ratio: 16 / 11;
    border-radius: 22px;
    overflow: hidden;
    background: #e2e8f0;
    box-shadow:
        0 24px 60px rgba(15, 23, 42, 0.12),
        0 2px 8px rgba(15, 23, 42, 0.05);
}

.reach-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.9s cubic-bezier(0.22, 0.61, 0.36, 1);
}

.reach-item:hover .reach-media img {
    transform: scale(1.05);
}

.reach-caption {
    position: absolute;
    bottom: 16px;
    left: 16px;
    padding: 7px 15px;
    border-radius: 100px;
    font-size: 0.7em;
    letter-spacing: 0.4px;
    color: #334155;
    background: rgba(255, 255, 255, 0.78);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.55);
}

.reach-body {
    max-width: 440px;
}

.reach-item:not(.is-reversed) .reach-body {
    padding-right: 12px;
}

.reach-item.is-reversed .reach-body {
    padding-left: 12px;
}

.body-label {
    display: block;
    font-size: 0.68em;
    font-weight: 500;
    letter-spacing: 2.8px;
    text-transform: uppercase;
    color: #2563eb;
    margin-bottom: 16px;
}

.body-title {
    font-size: 2em;
    font-weight: 600;
    letter-spacing: -0.9px;
    line-height: 1.2;
    color: #0f172a;
    margin-bottom: 18px;
}

.body-text {
    font-size: 0.93em;
    line-height: 1.95;
    color: #64748b;
}

@media (max-width: 900px) {
    .our-reach {
        padding: 90px 16px 110px;
    }

    .reach-stack {
        gap: 72px;
    }

    .reach-item,
    .reach-item.is-reversed {
        grid-template-columns: 1fr;
        gap: 26px;
    }

    .reach-item.is-reversed .reach-media {
        order: 0;
    }

    .reach-body,
    .reach-item:not(.is-reversed) .reach-body,
    .reach-item.is-reversed .reach-body {
        max-width: none;
        padding: 0 4px;
    }
}

@media (max-width: 600px) {
    .body-title {
        font-size: 1.6em;
    }

    .body-text {
        font-size: 0.88em;
    }

    .reach-media {
        border-radius: 16px;
    }
}
</style>
