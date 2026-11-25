<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, MapPin } from '@lucide/vue';
import { computed } from 'vue';
import type { Destination, DestinationSection } from '@/types';

const props = defineProps<{
    destination: Destination & { sections: DestinationSection[] };
    whatsappNumber: string;
}>();

const sections = computed(() => props.destination.sections ?? []);

const heroImage = computed(() => props.destination.image || '/bromo.jpg');

const whatsappUrl = computed(() => {
    const message = `Halo, saya ingin bertanya tentang destinasi ${props.destination.name}.`;

    return `https://wa.me/${props.whatsappNumber}?text=${encodeURIComponent(message)}`;
});
</script>

<template>
    <article class="destination-page">
        <div class="hero">
            <img :src="heroImage" :alt="destination.name" class="hero-img" />
            <div class="hero-overlay"></div>

            <Link href="/" class="back-link">
                <ArrowLeft class="h-4 w-4" />
                Back to Home
            </Link>

            <div class="hero-content">
                <span v-if="destination.location" class="location-badge">
                    <MapPin class="h-3.5 w-3.5" />
                    {{ destination.location }}
                </span>
                <h1 class="hero-title">{{ destination.name }}</h1>
                <p v-if="destination.short_description" class="hero-subtitle">
                    {{ destination.short_description }}
                </p>
            </div>
        </div>

        <div class="body">
            <div v-if="destination.description" class="intro">
                <p>{{ destination.description }}</p>
            </div>

            <div class="sections">
                <section
                    v-for="(section, index) in sections"
                    :key="section.id"
                    class="section"
                    :class="{
                        'has-image': section.image,
                        reverse: index % 2 === 1,
                    }"
                >
                    <div v-if="section.image" class="section-image">
                        <img
                            :src="section.image"
                            :alt="section.title"
                            loading="lazy"
                        />
                    </div>
                    <div class="section-text">
                        <span class="section-index">{{
                            String(index + 1).padStart(2, '0')
                        }}</span>
                        <h2 class="section-title">{{ section.title }}</h2>
                        <p
                            v-if="section.description"
                            class="section-description"
                        >
                            {{ section.description }}
                        </p>
                    </div>
                </section>
            </div>

            <div
                v-if="!destination.description && sections.length === 0"
                class="empty"
            >
                Information for this destination is not yet available.
            </div>

            <div class="cta">
                <div>
                    <h2 class="cta-title">
                        Interested in Exploring {{ destination.name }}?
                    </h2>
                    <p class="cta-text">
                        Contact us to plan your trip.
                    </p>
                </div>
                <div class="cta-actions">
                    <a
                        :href="whatsappUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-primary"
                    >
                        Contact via WhatsApp
                    </a>
                    
                </div>
            </div>
        </div>
    </article>
</template>

<style scoped>
.destination-page {
    min-height: 100vh;
    background: #ffffff;
    color: #0f172a;
}

.hero {
    position: relative;
    height: 72vh;
    min-height: 520px;
    overflow: hidden;
}

.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        #0d0d12 0%,
        rgba(13, 13, 18, 0.55) 45%,
        rgba(13, 13, 18, 0.25) 100%
    );
}

.back-link {
    position: absolute;
    top: 100px;
    left: 40px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    border-radius: 999px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(13, 13, 18, 0.55);
    backdrop-filter: blur(8px);
    color: #ffffff;
    font-size: 0.85em;
    text-decoration: none;
    transition:
        background 0.3s ease,
        border-color 0.3s ease;
}

.back-link:hover {
    background: rgba(59, 130, 246, 0.35);
    border-color: rgba(59, 130, 246, 0.6);
}

.hero-content {
    position: absolute;
    left: 50%;
    bottom: 56px;
    z-index: 2;
    width: 100%;
    max-width: 900px;
    padding: 0 20px;
    transform: translateX(-50%);
}

.location-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 16px;
    padding: 6px 16px;
    border-radius: 999px;
    border: 1px solid rgba(59, 130, 246, 0.3);
    background: rgba(59, 130, 246, 0.15);
    color: #bfdbfe;
    font-size: 0.8em;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 500;
}

.hero-title {
    margin: 0 0 16px;
    font-size: 4em;
    line-height: 1.05;
    letter-spacing: -1.5px;
    color: #ffffff;
}

.hero-subtitle {
    max-width: 620px;
    margin: 0;
    font-size: 1.1em;
    line-height: 1.7;
    color: #d4d4d8;
}

.body {
    max-width: 900px;
    margin: 0 auto;
    padding: 80px 20px 100px;
}

.intro {
    padding-left: 24px;
    border-left: 3px solid #3b82f6;
    margin-bottom: 70px;
}

.intro p {
    margin: 0;
    font-size: 1.1em;
    line-height: 1.85;
    color: #475569;
    white-space: pre-line;
}

.sections {
    display: flex;
    flex-direction: column;
    gap: 70px;
}

.section {
    display: block;
}

.section.has-image {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: center;
}

.section.has-image.reverse .section-image {
    order: 2;
}

.section-image {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    aspect-ratio: 4 / 3;
}

.section-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.section-image:hover img {
    transform: scale(1.05);
}

.section-index {
    display: block;
    margin-bottom: 12px;
    font-size: 0.8em;
    letter-spacing: 3px;
    color: #3b82f6;
    font-weight: 600;
}

.section-title {
    margin: 0 0 16px;
    font-size: 2em;
    font-weight: 600;
    letter-spacing: -0.5px;
    color: #0f172a;
}

.section-description {
    margin: 0;
    font-size: 1.02em;
    line-height: 1.85;
    color: #475569;
    white-space: pre-line;
}

.empty {
    padding: 40px 0;
    text-align: center;
    color: #64748b;
}

.cta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    margin-top: 90px;
    padding: 40px;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: linear-gradient(
        135deg,
        rgba(13, 13, 18, 0.8),
        rgba(10, 10, 16, 0.9)
    );
    color: #ffffff;
}

.cta-title {
    margin: 0 0 8px;
    font-size: 1.5em;
    color: #ffffff;
}

.cta-text {
    margin: 0;
    color: #cbd5e1;
}

.cta-actions {
    display: flex;
    flex-shrink: 0;
    gap: 12px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 22px;
    border-radius: 10px;
    font-size: 0.9em;
    font-weight: 500;
    text-decoration: none;
    transition:
        transform 0.3s ease,
        background 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn-primary {
    background: #25d366;
    color: #ffffff;
}

.btn-secondary {
    border: 1px solid #3b82f6;
    color: #3b82f6;
}

.btn-secondary:hover {
    background: rgba(59, 130, 246, 0.08);
}

@media (max-width: 900px) {
    .hero {
        height: 60vh;
        min-height: 440px;
    }

    .hero-title {
        font-size: 2.8em;
    }

    .back-link {
        top: 86px;
        left: 20px;
    }

    .body {
        padding: 56px 20px 80px;
    }

    .section.has-image {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .section.has-image.reverse .section-image {
        order: 0;
    }

    .section-title {
        font-size: 1.6em;
    }

    .cta {
        flex-direction: column;
        align-items: flex-start;
        padding: 30px;
    }

    .cta-actions {
        flex-wrap: wrap;
    }
}

@media (max-width: 640px) {
    .hero-title {
        font-size: 2.2em;
    }

    .hero-subtitle {
        font-size: 0.95em;
    }

    .sections {
        gap: 48px;
    }

    .intro {
        margin-bottom: 48px;
    }
}
</style>
