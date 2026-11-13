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
      <article v-for="(item, index) in services" :key="index" class="service-card">
        <div class="card-icon-wrap">
          <span class="card-icon">{{ item.icon }}</span>
        </div>

        <h3 class="service-card-title">{{ item.title }}</h3>

        <p class="service-card-desc">{{ item.description }}</p>
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
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 30px 24px;
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.03);
  transition: border-color 0.25s ease, background 0.25s ease, transform 0.25s ease;
}

.service-card:hover {
  border-color: rgba(167, 139, 250, 0.35);
  background: rgba(255, 255, 255, 0.05);
  transform: translateY(-4px);
}

.card-icon-wrap {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 64px;
  height: 64px;
  margin-bottom: 18px;
  border-radius: 50%;
  border: 1px solid rgba(167, 139, 250, 0.3);
  background: rgba(167, 139, 250, 0.1);
}

.card-icon {
  font-size: 1.75rem;
  line-height: 1;
}

.service-card-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 10px;
  letter-spacing: -0.01em;
}

.service-card-desc {
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
