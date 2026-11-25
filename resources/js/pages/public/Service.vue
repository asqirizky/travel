<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowRight,
    BedDouble,
    Car,
    Check,
    Compass,
    Mountain,
    Route,
    ShieldCheck,
} from '@lucide/vue';
import { onMounted, onUnmounted, ref } from 'vue';
import { about, contact } from '@/routes';

const parallaxBg = ref<HTMLElement | null>(null);
const pageRef = ref<HTMLElement | null>(null);
let handleScroll: (() => void) | undefined;
let observer: IntersectionObserver | undefined;

const contactUrl = contact().url;
const aboutUrl = about().url;

const services = [
    {
        icon: Compass,
        title: 'Tour Packages',
        description:
            'Curated group journeys to Bali, Bromo, Raja Ampat, and beyond — led by guides who grew up around these places.',
        includes: ['Local guides', 'Entrance fees', 'Comfortable transport'],
    },
    {
        icon: Route,
        title: 'Custom Itinerary',
        description:
            'A travel plan built around your pace, your budget, and the things you actually care about seeing.',
    },
    {
        icon: Car,
        title: 'Transportation',
        description:
            'Airport transfers, inter-city drives, and private cars with drivers who know every turn of the road.',
    },
    {
        icon: BedDouble,
        title: 'Accommodation',
        description:
            'Handpicked hotels, villas, and homestays — from simple rooms with a view to stays you will not want to leave.',
    },
    {
        icon: ShieldCheck,
        title: 'Travel Insurance',
        description:
            'Coverage for health, baggage, delays, and emergencies, so small surprises never become big problems.',
    },
    {
        icon: Mountain,
        title: 'Adventure Trips',
        description:
            'Volcano treks, reef dives, river rafting, and jungle trails for travelers who want to come back with stories.',
        includes: ['Certified guides', 'Safety equipment', 'Small groups'],
    },
];

const steps = [
    {
        number: '01',
        title: 'Tell us your plan',
        description:
            'Share your dates, the places you dream about, and your budget. A short message is enough to start.',
    },
    {
        number: '02',
        title: 'We shape the journey',
        description:
            'Our local team designs the route, books the details, and sends you an itinerary you can adjust freely.',
    },
    {
        number: '03',
        title: 'Travel with ease',
        description:
            'Guides, transport, and stays are ready when you land. You only need to be present and enjoy it.',
    },
];

onMounted(() => {
    handleScroll = () => {
        if (!parallaxBg.value) {
            return;
        }

        const rect = parallaxBg.value.getBoundingClientRect();
        parallaxBg.value.style.transform = `translate3d(0, ${rect.top * 0.25}px, 0)`;
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    const targets =
        pageRef.value?.querySelectorAll<HTMLElement>('[data-reveal]');

    if (targets?.length) {
        observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer?.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15, rootMargin: '0px 0px -50px 0px' },
        );

        targets.forEach((target) => observer?.observe(target));
    }
});

onUnmounted(() => {
    if (handleScroll) {
        window.removeEventListener('scroll', handleScroll);
    }

    observer?.disconnect();
});
</script>

<template>
    <Head title="Service - Ijen Bromo Travel" />

    <section ref="pageRef" class="svc">
        <div class="svc-hero">
            <div ref="parallaxBg" class="svc-hero-bg"></div>
            <div class="svc-hero-overlay"></div>

            <div class="svc-hero-inner">
                <span class="svc-eyebrow">
                    <span class="svc-dot"></span>
                    Our Services
                </span>
                <h1 class="svc-hero-title">
                    Everything you need<br />
                    <span>for the journey.</span>
                </h1>
                <p class="svc-hero-desc">
                    From curated tour packages to personal itineraries, we take
                    care of the details so you can focus on the places, the
                    people, and the moments in between.
                </p>

                <div class="svc-actions">
                    <Link :href="contactUrl" class="svc-btn svc-btn-primary">
                        Plan your trip
                        <ArrowRight :size="16" :stroke-width="2" />
                    </Link>
                    <Link :href="aboutUrl" class="svc-btn svc-btn-ghost">
                        Our story
                    </Link>
                </div>
            </div>
        </div>

        <div class="svc-body">
            <section class="svc-intro" data-reveal>
                <div class="svc-intro-copy">
                    <span class="svc-label">What we do</span>
                    <h2 class="svc-head-title">
                        Six ways we make<br />
                        traveling easier
                    </h2>
                    <p class="svc-head-desc">
                        Every part of the trip is handled by a local team that
                        knows the islands by heart — so nothing feels rushed,
                        generic, or left to chance.
                    </p>
                </div>

                <div class="svc-intro-note">
                    <span class="svc-note-line"></span>
                    <p>
                        One team, every detail — from the first message to the
                        last sunset.
                    </p>
                </div>
            </section>

            <div class="svc-bento">
                <article
                    v-for="(item, index) in services"
                    :key="item.title"
                    class="svc-card"
                    :class="{ 'is-featured': item.includes }"
                    data-reveal
                    :style="{ '--delay': `${(index % 3) * 70}ms` }"
                >
                    <span class="svc-index">{{
                        String(index + 1).padStart(2, '0')
                    }}</span>
                    <div class="svc-card-body">
                        <span class="svc-icon">
                            <component
                                :is="item.icon"
                                :size="22"
                                :stroke-width="1.6"
                            />
                        </span>
                        <div class="svc-card-copy">
                            <h3 class="svc-card-title">{{ item.title }}</h3>
                            <p class="svc-card-desc">{{ item.description }}</p>
                        </div>
                    </div>

                    <ul v-if="item.includes" class="svc-list">
                        <li v-for="point in item.includes" :key="point">
                            <Check :size="14" :stroke-width="2.2" />
                            {{ point }}
                        </li>
                    </ul>
                </article>
            </div>

            <!-- <section class="svc-process">
                <div class="svc-process-head" data-reveal>
                    <span class="svc-label">How it works</span>
                    <h2 class="svc-head-title">Three steps, no guesswork</h2>
                </div>

                <ol class="svc-steps">
                    <li
                        v-for="(step, index) in steps"
                        :key="step.number"
                        class="svc-step"
                        data-reveal
                        :style="{ '--delay': `${index * 90}ms` }"
                    >
                        <span class="svc-step-number">{{ step.number }}</span>
                        <h3 class="svc-step-title">{{ step.title }}</h3>
                        <p class="svc-step-desc">{{ step.description }}</p>
                    </li>
                </ol>
            </section> -->

            <section class="svc-cta" data-reveal>
                <div class="svc-cta-glow"></div>
                <div class="svc-cta-inner">
                    <div>
                        <h2 class="svc-cta-title">Ready when you are.</h2>
                        <p class="svc-cta-desc">
                            Tell us your dates, your budget, and the places on
                            your mind. We will take it from there.
                        </p>
                    </div>
                    <Link :href="contactUrl" class="svc-btn svc-btn-primary">
                        Start planning
                        <ArrowRight :size="16" :stroke-width="2" />
                    </Link>
                </div>
            </section>
        </div>
    </section>
</template>

<style scoped>
.svc {
    position: relative;
    background: #f8fafc;
    overflow: hidden;
}

.svc-hero {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 82vh;
    padding: 160px 20px 140px;
    overflow: hidden;
}

.svc-hero-bg {
    position: absolute;
    inset: -18% 0;
    background: url('/destinations/red-island-NuRQDIFp.jpg') center / cover
        no-repeat;
    will-change: transform;
    z-index: 0;
}

.svc-hero-overlay {
    position: absolute;
    inset: 0;
    background:
        /* radial-gradient(
            ellipse at 50% 36%,
            rgba(228, 228, 228, 0.28) 0%,
            rgba(2, 6, 23, 0.58) 78%
        ), */
        linear-gradient(
            to bottom,
            rgba(2, 6, 23, 0.5) 0%,
            rgba(2, 6, 23, 0.56) 45%,
            rgba(15, 23, 42, 0.88) 82%,
            #1b1b1b 100%
        );
    z-index: 1;
}

.svc-hero-inner {
    position: relative;
    z-index: 2;
    max-width: 660px;
    text-align: center;
}

.svc-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 0.72em;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #bfdbfe;
    padding: 7px 16px;
    border-radius: 100px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.22);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    margin-bottom: 28px;
}

.svc-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #7dd3fc;
    box-shadow: 0 0 0 4px rgba(125, 211, 252, 0.2);
}

.svc-hero-title {
    font-size: 3.2em;
    font-weight: 600;
    line-height: 1.13;
    letter-spacing: -1.6px;
    color: #ffffff;
    margin: 0 0 22px;
    text-shadow: 0 6px 40px rgba(2, 6, 23, 0.6);
}

.svc-hero-title span {
    color: #93c5fd;
}

.svc-hero-desc {
    font-size: 1em;
    line-height: 1.8;
    color: #cbd5e1;
    max-width: 540px;
    margin: 0 auto 38px;
    text-shadow: 0 2px 18px rgba(2, 6, 23, 0.6);
}

.svc-actions {
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}

.svc-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 26px;
    border-radius: 100px;
    font-size: 0.88em;
    font-weight: 500;
    text-decoration: none;
    transition:
        transform 0.3s ease,
        background 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}

.svc-btn:hover {
    transform: translateY(-2px);
}

.svc-btn-primary {
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 12px 30px rgba(37, 99, 235, 0.35);
}

.svc-btn-primary:hover {
    background: #1d4ed8;
    box-shadow: 0 16px 38px rgba(37, 99, 235, 0.42);
}

.svc-btn-ghost {
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.32);
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.svc-btn-ghost:hover {
    border-color: rgba(255, 255, 255, 0.6);
    background: rgba(255, 255, 255, 0.12);
}

.svc-body {
    position: relative;
    z-index: 2;
    max-width: 1120px;
    margin: 0 auto;
    padding: 40px 20px 140px;
}

.svc-intro {
    display: grid;
    grid-template-columns: minmax(0, 1.5fr) minmax(0, 0.7fr);
    align-items: end;
    gap: 56px;
    margin-bottom: 56px;
}

.svc-intro-copy {
    max-width: 620px;
}

.svc-intro-note {
    max-width: 260px;
    padding-bottom: 6px;
}

.svc-intro-note p {
    font-size: 0.84em;
    line-height: 1.8;
    color: #64748b;
    margin: 0;
}

.svc-note-line {
    display: block;
    width: 34px;
    height: 2px;
    background: #2563eb;
    margin-bottom: 16px;
}

.svc-label {
    display: block;
    font-size: 0.68em;
    font-weight: 500;
    letter-spacing: 2.8px;
    text-transform: uppercase;
    color: #2563eb;
    margin-bottom: 16px;
}

.svc-head-title {
    font-size: 2.3em;
    font-weight: 600;
    letter-spacing: -1px;
    line-height: 1.18;
    color: #0f172a;
    margin: 0 0 16px;
}

.svc-head-desc {
    font-size: 0.94em;
    line-height: 1.85;
    color: #64748b;
    margin: 0;
}

.svc-bento {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
}

.svc-card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-height: 272px;
    padding: 26px;
    border-radius: 20px;
    background: #ffffff;
    border: 1px solid rgba(15, 23, 42, 0.07);
    box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
    transition:
        opacity 0.7s ease,
        transform 0.5s ease,
        box-shadow 0.4s ease,
        border-color 0.4s ease;
}

.svc-card:hover {
    transform: translateY(-4px);
    border-color: rgba(37, 99, 235, 0.22);
    box-shadow: 0 24px 50px rgba(15, 23, 42, 0.08);
}

.svc-card.is-featured {
    background: linear-gradient(155deg, #f1f7ff 0%, #ffffff 62%);
    border-color: rgba(37, 99, 235, 0.16);
}

.svc-index {
    font-size: 0.7em;
    font-weight: 500;
    letter-spacing: 1.5px;
    color: #cbd5e1;
    font-variant-numeric: tabular-nums;
    margin-bottom: 28px;
}

.svc-card-body {
    display: flex;
    align-items: flex-start;
    gap: 16px;
}

.svc-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    color: #2563eb;
    background: rgba(37, 99, 235, 0.08);
    border: 1px solid rgba(37, 99, 235, 0.12);
    transition:
        background 0.35s ease,
        color 0.35s ease,
        transform 0.35s ease;
}

.svc-card:hover .svc-icon {
    background: #2563eb;
    color: #ffffff;
    transform: rotate(-6deg);
}

.svc-card-title {
    font-size: 1.08em;
    font-weight: 600;
    letter-spacing: -0.3px;
    color: #0f172a;
    margin: 0 0 8px;
}

.svc-card-desc {
    font-size: 0.84em;
    line-height: 1.75;
    color: #64748b;
    margin: 0;
}

.svc-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px 14px;
    margin: auto 0 0;
    padding: 18px 0 0;
    border-top: 1px solid rgba(15, 23, 42, 0.07);
    list-style: none;
}

.svc-list li {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.76em;
    color: #475569;
    letter-spacing: 0.1px;
}

.svc-list li svg {
    color: #2563eb;
    flex-shrink: 0;
}

.svc-process {
    margin-top: 120px;
}

.svc-process-head {
    max-width: 480px;
    margin-bottom: 48px;
}

.svc-steps {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 40px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.svc-step {
    position: relative;
    padding-top: 26px;
    border-top: 1px solid rgba(15, 23, 42, 0.1);
    transition:
        opacity 0.7s ease,
        transform 0.7s ease,
        border-color 0.4s ease;
}

.svc-step:hover {
    border-color: rgba(37, 99, 235, 0.45);
}

.svc-step-number {
    display: block;
    font-size: 0.72em;
    font-weight: 500;
    letter-spacing: 2px;
    color: #94a3b8;
    margin-bottom: 18px;
    font-variant-numeric: tabular-nums;
    transition: color 0.35s ease;
}

.svc-step:hover .svc-step-number {
    color: #2563eb;
}

.svc-step-title {
    font-size: 1.1em;
    font-weight: 600;
    letter-spacing: -0.2px;
    color: #0f172a;
    margin: 0 0 10px;
}

.svc-step-desc {
    font-size: 0.86em;
    line-height: 1.8;
    color: #64748b;
    margin: 0;
}

.svc-cta {
    position: relative;
    margin-top: 120px;
    padding: 56px;
    border-radius: 26px;
    overflow: hidden;
    background: linear-gradient(140deg, #0b1220 0%, #111f38 100%);
    color: #f8fafc;
}

.svc-cta-glow {
    position: absolute;
    top: -140px;
    right: -80px;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: radial-gradient(
        circle,
        rgba(59, 130, 246, 0.35) 0%,
        transparent 70%
    );
    filter: blur(10px);
    pointer-events: none;
}

.svc-cta-inner {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
}

.svc-cta-title {
    font-size: 1.8em;
    font-weight: 600;
    letter-spacing: -0.7px;
    margin: 0 0 12px;
}

.svc-cta-desc {
    font-size: 0.9em;
    line-height: 1.8;
    color: #94a3b8;
    max-width: 420px;
    margin: 0;
}

[data-reveal] {
    opacity: 0;
    transform: translateY(22px);
    transition:
        opacity 0.75s ease var(--delay, 0ms),
        transform 0.75s ease var(--delay, 0ms);
}

[data-reveal].is-visible {
    opacity: 1;
    transform: translateY(0);
}

.svc-card[data-reveal] {
    transition:
        opacity 0.7s ease var(--delay, 0ms),
        transform 0.5s ease var(--delay, 0ms),
        box-shadow 0.4s ease,
        border-color 0.4s ease;
}

.svc-card[data-reveal].is-visible {
    transform: translateY(0);
}

.svc-card[data-reveal].is-visible:hover {
    transform: translateY(-4px);
}

@media (max-width: 1024px) {
    .svc-bento {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .svc-steps {
        gap: 28px;
    }
}

@media (max-width: 900px) {
    .svc-hero {
        min-height: 76vh;
        padding: 140px 20px 110px;
    }

    .svc-hero-title {
        font-size: 2.4em;
    }

    .svc-body {
        padding: 20px 16px 110px;
    }

    .svc-intro {
        grid-template-columns: 1fr;
        gap: 24px;
        margin-bottom: 44px;
    }

    .svc-intro-note {
        max-width: 420px;
    }

    .svc-head-title {
        font-size: 1.9em;
    }

    .svc-head-title br {
        display: none;
    }

    .svc-process {
        margin-top: 90px;
    }

    .svc-steps {
        grid-template-columns: 1fr;
        gap: 32px;
    }

    .svc-cta {
        margin-top: 90px;
        padding: 38px 28px;
    }

    .svc-cta-inner {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 640px) {
    .svc-hero-title {
        font-size: 2em;
        letter-spacing: -1px;
    }

    .svc-bento {
        grid-template-columns: 1fr;
    }

    .svc-card {
        min-height: 0;
        padding: 24px;
    }

    .svc-actions {
        flex-direction: column;
        width: 100%;
    }

    .svc-btn {
        justify-content: center;
    }

    .svc-cta {
        border-radius: 20px;
    }

    .svc-cta-title {
        font-size: 1.5em;
    }
}
</style>
