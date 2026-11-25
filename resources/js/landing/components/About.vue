<template>
    <section class="about">
        <div class="parallax-bg" ref="parallaxBg"></div>
        <div class="overlay"></div>

        <div class="hero-content">
            <span class="badge">About Us</span>
            <h2 class="hero-title">
                Explore the Beauty of<br />Indonesia With Us
            </h2>
            <p class="hero-desc">
                This website is an Indonesian travel guide platform that
                provides information on the best destinations, travel packages,
                and vacation inspiration. From Sabang to Merauke, we're here to
                help you discover unforgettable experiences in every corner of
                the archipelago.
            </p>
        </div>
    </section>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

const parallaxBg = ref<HTMLElement | null>(null);

let handleScroll: (() => void) | undefined;

onMounted(() => {
    handleScroll = () => {
        if (!parallaxBg.value) {
            return;
        }

        const rect = parallaxBg.value.getBoundingClientRect();
        const speed = 0.3;

        parallaxBg.value.style.transform = `translateY(${rect.top * speed}px)`;
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
    if (handleScroll) {
        window.removeEventListener('scroll', handleScroll);
    }
});
</script>

<style scoped>
.about {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 140px 20px 100px;
}

.parallax-bg {
    position: absolute;
    inset: -20% 0;
    background: url('https://images.unsplash.com/photo-1615104168825-3d6391ccc228?q=80&w=870')
        center / cover no-repeat;
    will-change: transform;
    z-index: 0;
}

.overlay {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(
            ellipse at 50% 30%,
            #e1eaff59 0%,
            rgba(172, 170, 170, 0.096) 70%
        ),
        linear-gradient(
            to bottom,
            rgba(2, 6, 23, 0.55) 0%,
            rgba(2, 6, 23, 0.9) 65%,
            #020617 100%
        );
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 700px;
    margin-bottom: 80px;
}

.badge {
    display: inline-block;
    font-size: 0.85em;
    color: #93c5fd;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-weight: 500;
    margin-bottom: 20px;
    background: rgba(59, 130, 246, 0.12);
    padding: 6px 18px;
    border-radius: 20px;
    border: 1px solid rgba(147, 197, 253, 0.25);
}

.hero-title {
    font-size: 3.5em;
    font-weight: 700;
    color: #f8fafc;
    line-height: 1.15;
    margin-bottom: 24px;
    letter-spacing: -1.5px;
}

.hero-desc {
    font-size: 1.05em;
    color: #94a3b8;
    line-height: 1.8;
    max-width: 580px;
    margin: 0 auto;
}
@media (max-width: 900px) {
    .hero-title {
        font-size: 2.4em;
    }

    .about {
        padding: 100px 16px 60px;
    }

    .hero-content {
        margin-bottom: 60px;
    }
}
</style>
