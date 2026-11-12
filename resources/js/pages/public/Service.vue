<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';

const parallaxBg = ref<HTMLElement | null>(null);
let handleScroll: (() => void) | undefined;

onMounted(() => {
  handleScroll = () => {
    if (!parallaxBg.value) {
      return;
    }

    const rect = parallaxBg.value.getBoundingClientRect();
    parallaxBg.value.style.transform = `translate3d(0, ${rect.top * 0.3}px, 0)`;
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();
});

onUnmounted(() => {
  if (handleScroll) {
    window.removeEventListener('scroll', handleScroll);
  }
});

const services = [
  {
    icon: '🏕️',
    title: 'Tour Packages',
    description: 'Curated group tour packages to top destinations like Bali, Bromo, and Raja Ampat with experienced local guides.',
  },
  {
    icon: '🗺️',
    title: 'Custom Itinerary',
    description: 'Tailor-made travel plans designed around your preferences, budget, and schedule for a personal experience.',
  },
  {
    icon: '🚗',
    title: 'Transportation',
    description: 'Reliable airport transfers, inter-city travel, and private car rentals with professional drivers.',
  },
  {
    icon: '🏨',
    title: 'Accommodation',
    description: 'Handpicked hotels, villas, and homestays ranging from budget-friendly to luxury with the best views.',
  },
  {
    icon: '🛡️',
    title: 'Travel Insurance',
    description: 'Comprehensive travel protection covering health, baggage, trip cancellation, and emergency assistance.',
  },
  {
    icon: '🎯',
    title: 'Adventure Trips',
    description: 'Thrilling adventures including volcano trekking, diving, white-water rafting, and jungle exploration.',
  }
]
</script>

<template>
  <Head title="Service - Ijen Bromo Travel" />

  <section class="service-page">
    <div ref="parallaxBg" class="service-parallax"></div>
    <div class="service-overlay"></div>

    <div class="service-hero">
      <span class="service-badge">Our Services</span>
      <h1 class="service-title">Travel Services<br><span class="title-highlight">We Provide</span></h1>
      <p class="service-desc">
        From curated tour packages to personalized itineraries, we offer everything you need
        to make your Indonesian adventure seamless and unforgettable.
      </p>
    </div>

    <div class="services-grid">
      <article
        v-for="(item, index) in services"
        :key="index"
        class="service-card"
      >
        <svg
          class="card-waves"
          viewBox="0 0 360 220"
          preserveAspectRatio="none"
          aria-hidden="true"
        >
          <defs>
            <linearGradient :id="`wave-fill-${index}`" x1="0" y1="0" x2="1" y2="1">
              <stop offset="0%" stop-color="#a78bfa" stop-opacity="0.3" />
              <stop offset="100%" stop-color="#818cf8" stop-opacity="0.04" />
            </linearGradient>
            <linearGradient :id="`wave-stroke-${index}`" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#a78bfa" stop-opacity="0.05" />
              <stop offset="50%" stop-color="#c4b5fd" stop-opacity="0.75" />
              <stop offset="100%" stop-color="#818cf8" stop-opacity="0.1" />
            </linearGradient>
          </defs>
          <path
            d="M0,110 C60,78 112,148 180,118 C248,88 302,142 360,108 L360,220 L0,220 Z"
            :fill="`url(#wave-fill-${index})`"
          />
          <path
            d="M0,140 C70,100 122,176 190,146 C258,116 312,166 360,134"
            fill="none"
            :stroke="`url(#wave-stroke-${index})`"
            stroke-width="1.5"
          />
          <path
            d="M0,172 C80,136 132,202 200,172 C268,142 322,192 360,166"
            fill="none"
            :stroke="`url(#wave-stroke-${index})`"
            stroke-width="1"
            opacity="0.55"
          />
        </svg>

        <div class="card-icon-wrap">
          <span class="card-icon">{{ item.icon }}</span>
        </div>

        <h3 class="service-card-title">{{ item.title }}</h3>

        <div class="service-card-copy">
          <svg
            class="copy-wave"
            viewBox="0 0 300 120"
            preserveAspectRatio="none"
            aria-hidden="true"
          >
            <defs>
              <linearGradient :id="`copy-fill-${index}`" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#a78bfa" stop-opacity="0.18" />
                <stop offset="100%" stop-color="#818cf8" stop-opacity="0.06" />
              </linearGradient>
            </defs>
            <path
              d="M16,14 C48,2 90,22 140,10 C190,-2 250,6 286,16 C296,44 292,82 284,104 C250,116 200,100 150,112 C100,124 44,116 16,104 C6,78 6,40 16,14 Z"
              :fill="`url(#copy-fill-${index})`"
              stroke="rgba(196, 181, 253, 0.28)"
              stroke-width="1"
            />
          </svg>
          <p class="service-card-desc">{{ item.description }}</p>
        </div>
      </article>
    </div>
  </section>
</template>

<style scoped>
.service-page {
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 96px 20px 80px;
  background: #0d0d12;
  color: #f4f4f5;
}

.service-parallax {
  position: absolute;
  inset: -20% 0;
  background:
    linear-gradient(135deg, rgba(10, 10, 20, 0.55) 0%, rgba(20, 15, 40, 0.65) 100%),
    url('/packages/rajaampat.jpg') center / cover no-repeat;
  z-index: 0;
  will-change: transform;
}

.service-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(13, 13, 18, 0.45) 0%,
    rgba(13, 13, 18, 0.82) 48%,
    rgba(13, 13, 18, 0.96) 100%
  );
  z-index: 1;
}

.service-hero {
  position: relative;
  z-index: 2;
  text-align: center;
  max-width: 660px;
  margin: 0 auto 64px;
}

.service-badge {
  display: inline-flex;
  align-items: center;
  font-size: 0.8rem;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #a78bfa;
  background: rgba(167, 139, 250, 0.12);
  border: 1px solid rgba(167, 139, 250, 0.2);
  padding: 6px 18px;
  border-radius: 20px;
  margin-bottom: 16px;
}

.service-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.2;
  margin: 0 0 16px;
  letter-spacing: -0.02em;
  color: #ffffff;
}

.title-highlight {
  color: #a78bfa;
}

.service-desc {
  font-size: 1rem;
  color: #a1a1aa;
  line-height: 1.7;
  margin: 0;
}

.services-grid {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 960px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
}

.service-card {
  position: relative;
  isolation: isolate;
  overflow: hidden;
  min-height: 330px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 34px 24px 26px;
  border-radius: 24px;
  border: 1px solid rgba(255, 255, 255, 0.06);
  background: linear-gradient(145deg, rgba(30, 30, 35, 0.9), rgba(22, 22, 28, 0.95));
  box-shadow:
    0 4px 20px rgba(0, 0, 0, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.04);
  transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
}

.service-card::before {
  content: '';
  position: absolute;
  top: -70px;
  left: 50%;
  width: 220px;
  height: 160px;
  margin-left: -110px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(167, 139, 250, 0.22) 0%, rgba(167, 139, 250, 0) 70%);
  pointer-events: none;
}

.service-card:hover {
  border-color: rgba(167, 139, 250, 0.3);
  box-shadow:
    0 20px 60px rgba(0, 0, 0, 0.5),
    0 0 40px rgba(167, 139, 250, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.06);
  transform: translateY(-6px);
}

.card-waves {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 58%;
  z-index: 0;
  pointer-events: none;
}

.card-icon-wrap {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 74px;
  height: 74px;
  margin: 0 auto 20px;
  border-radius: 50%;
  border: 1px solid rgba(196, 181, 253, 0.4);
  background: linear-gradient(140deg, rgba(167, 139, 250, 0.24) 0%, rgba(129, 140, 248, 0.16) 100%);
  box-shadow:
    0 0 0 7px rgba(167, 139, 250, 0.06),
    0 14px 28px -14px rgba(167, 139, 250, 0.75);
}

.card-icon {
  font-size: 2rem;
  line-height: 1;
}

.service-card-title {
  position: relative;
  z-index: 1;
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 16px;
  letter-spacing: -0.01em;
}

.service-card-copy {
  position: relative;
  z-index: 1;
  width: 100%;
  margin-top: auto;
  padding: 16px 18px;
}

.copy-wave {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
  pointer-events: none;
}

.service-card-desc {
  position: relative;
  z-index: 1;
  font-size: 0.88rem;
  color: #a1a1aa;
  line-height: 1.65;
  margin: 0;
}

@media (max-width: 900px) {
  .service-page {
    padding: 80px 20px 60px;
  }

  .service-title {
    font-size: 2rem;
  }

  .services-grid {
    grid-template-columns: repeat(2, 1fr);
    max-width: 640px;
  }
}

@media (max-width: 600px) {
  .services-grid {
    grid-template-columns: 1fr;
    max-width: 360px;
  }

  .service-title {
    font-size: 1.75rem;
  }
}
</style>
