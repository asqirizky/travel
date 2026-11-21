<template>
  <section class="hero" ref="heroRef">
    <div v-for="(slide, index) in slides" :key="index" class="slide" :class="{ active: index === current, prev: index === prevIndex, 'slide-borobudur': index === 0 }">
      <img :src="slide.image" :alt="slide.name" loading="lazy">
    </div>

    <div class="overlay"></div>

    <div class="content">
      <div class="text">
        <span class="label">{{ slides[current].location }}</span>
        <h2 class="title">{{ slides[current].name }}</h2>
        <p class="desc">{{ slides[current].desc }}</p>
      </div>
    </div>

    <div class="controls" ref="controlsRef">
      <p class="visit-text" ref="visitTextRef">Visit Indonesia's<br>tourist destinations</p>
      <div class="thumbs-stage">
        <button class="thumb-nav prev" aria-label="Thumbnail sebelumnya" @click="prevSlide">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="thumbs">
          <TransitionGroup :name="`thumb-${direction}`">
            <button
              v-for="item in visibleThumbs"
              :key="item.index"
              class="thumb"
              :class="{ active: item.index === current }"
              @click="goTo(item.index)"
            >
              <img :src="item.slide.image" :alt="item.slide.name" loading="lazy">
            </button>
          </TransitionGroup>
        </div>
        <button class="thumb-nav next" aria-label="Thumbnail berikutnya" @click="next">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>
      <div class="counter">
        <span class="num">{{ formatted(current) }}</span>
        <span class="sep">—</span>
        <span class="total">{{ formatted(slides.length - 1) }}</span>
      </div>
    </div>

    <a
      class="wa-float"
      href="https://wa.me/6281216904379?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20paket%20wisata"
      target="_blank"
      rel="noopener noreferrer"
      aria-label="Hubungi kami via WhatsApp"
    >
      <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
    </a>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";

const current = ref(0)
const prevIndex = ref(-1)
const direction = ref('next')
const heroRef = ref(null)
const controlsRef = ref(null)
const visitTextRef = ref(null)
let interval

const slides = [
  {
    image: 'landing_hero/borobudur.jpg',
    name: 'Borobudur',
    location: 'Java Center',
    desc: 'Temples, surf, and sunset — the Island of the Gods awaits.'
  },
  {
    image: 'landing_hero/tumpak_sewu.jpg',
    name: 'Tumpak Sewu',
    location: 'Lumajang',
    desc: 'A majestic curtain of water falling into a lush emerald canyon.'
  },
  {
    image: 'landing_hero/prambanan.jpg',
    name: 'Prambanan',
    location: 'Yogyakarta',
    desc: 'Blue flames and a turquoise crater lake, a surreal volcanic wonder.'
  },
  {
    image: 'landing_hero/bromo.jpg',
    name: 'Bromo',
    location: 'East Java',
    desc: 'Watch the sunrise over an ancient volcanic landscape from the sea of sand.'
  },
  {
    image: 'landing_hero/ijen.jpg',
    name: 'Ijen Crater',
    location: 'Banyuwangi',
    desc: 'A glowing turquoise acid lake wrapped in the smoky embrace of Mount Ijen.'
  },
  {
    image: 'landing_hero/djawatan.jpg',
    name: 'De Djawatan',
    location: 'East Java',
    desc: 'Meet the legendary blue fire and the sulfur miners in the heart of the crater.'
  }
]

function goTo(index) {
  if (index === current.value) {
    return
  }

  const total = slides.length
  const forward = (index - current.value + total) % total
  direction.value = forward <= total / 2 ? 'next' : 'prev'

  prevIndex.value = current.value
  current.value = index
  resetInterval()
}

const visibleThumbs = computed(() => {
  const total = slides.length

  return [-1, 0, 1].map((offset) => {
    const index = (current.value + offset + total) % total

    return { index, slide: slides[index] }
  })
})

function prevSlide() {
  direction.value = 'prev'
  prevIndex.value = current.value
  current.value = (current.value - 1 + slides.length) % slides.length
  resetInterval()
}

function formatted(n) {
  return String(n + 1).padStart(2, '0')
}

function resetInterval() {
  clearInterval(interval)
  interval = setInterval(next, 5000)
}

function next() {
  direction.value = 'next'
  prevIndex.value = current.value
  current.value = (current.value + 1) % slides.length
}

let handleScroll

onMounted(() => {
  handleScroll = () => {
    const value = window.scrollY
    const imgs = heroRef.value?.querySelectorAll('.slide img')

    if (imgs) {
      imgs.forEach(el => {
        el.style.transform = `translateY(${value * 0.12}px) scale(1.1)`
      })
    }

    if (controlsRef.value) {
      controlsRef.value.style.transform = `translateY(${-value * 0.08}px)`
      controlsRef.value.style.opacity = Math.max(0, 1 - value / 500)
    }

    if (visitTextRef.value) {
      visitTextRef.value.style.transform = `translateY(${-value * 0.15}px)`
    }
  }

  window.addEventListener('scroll', handleScroll)
  interval = setInterval(next, 5000)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  clearInterval(interval)
})
</script>

<style scoped>
.hero {
  position: relative;
  height: 100vh;
  overflow: hidden;
  display: flex;
  align-items: center;
}

.slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  transition: opacity 1s ease, transform 1.2s ease;
  transform: scale(1.05);
}

.slide.active {
  opacity: 1;
  transform: scale(1);
  z-index: 1;
}

.slide.prev {
  opacity: 0;
  transform: scale(1.05);
  z-index: 0;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  will-change: transform;
}

.slide-borobudur img {
  object-position: center 70%;
}

.overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(13, 13, 18, 0.7) 0%, rgba(13, 13, 18, 0.2) 60%, transparent 100%);
  z-index: 2;
}

.hero::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 12%;
  background: linear-gradient(to top, #0d0d12, transparent);
  z-index: 3;
  pointer-events: none;
}

.content {
  position: relative;
  z-index: 4;
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 60px;
}

.text {
  max-width: 520px;
}

.label {
  display: inline-block;
  font-size: 0.85em;
  color: #a78bfa;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: 500;
  margin-bottom: 16px;
  background: rgba(167, 139, 250, 0.12);
  padding: 6px 16px;
  border-radius: 20px;
  border: 1px solid rgba(167, 139, 250, 0.2);
}

.title {
  font-size: 4.5em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.1;
  margin-bottom: 16px;
  letter-spacing: -1.5px;
}

.desc {
  font-size: 1.05em;
  color: #d4d4d8;
  line-height: 1.7;
}

.controls {
  position: absolute;
  right: 60px;
  bottom: 60px;
  z-index: 5;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 16px;
}

.thumbs-stage {
  --thumb-w: 100px;
  --thumb-h: 72px;
  --thumb-gap: 12px;
  --nav-size: 34px;
  position: relative;
  display: flex;
  align-items: center;
  gap: 12px;
}

.thumb-nav {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: var(--nav-size);
  height: var(--nav-size);
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.25);
  background: rgba(13, 13, 18, 0.55);
  color: #ffffff;
  cursor: pointer;
  backdrop-filter: blur(6px);
  transition: all 0.3s ease;
}

.thumb-nav:hover {
  background: rgba(167, 139, 250, 0.6);
  border-color: rgba(167, 139, 250, 0.8);
}

.thumbs {
  position: relative;
  display: flex;
  justify-content: center;
  gap: var(--thumb-gap);
}

.thumb {
  flex-shrink: 0;
  width: var(--thumb-w);
  height: var(--thumb-h);
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  border: 2px solid rgba(255, 255, 255, 0.15);
  padding: 0;
  background: none;
  transition: all 0.4s ease;
  opacity: 0.5;
  filter: grayscale(0.6);
}

.thumb.active {
  opacity: 1;
  border-color: #a78bfa;
  filter: grayscale(0);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(167, 139, 250, 0.3);
}

.thumb:hover {
  opacity: 0.8;
  border-color: rgba(167, 139, 250, 0.5);
}

.thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.thumb-next-move,
.thumb-prev-move {
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.thumb-next-enter-active,
.thumb-next-leave-active,
.thumb-prev-enter-active,
.thumb-prev-leave-active {
  transition: opacity 0.4s ease, transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.thumb-next-leave-active,
.thumb-prev-leave-active {
  position: absolute;
  top: 0;
}

.thumb-next-enter-from,
.thumb-prev-leave-to {
  opacity: 0;
  transform: translateX(50px) scale(0.9);
}

.thumb-prev-enter-from,
.thumb-next-leave-to {
  opacity: 0;
  transform: translateX(-50px) scale(0.9);
}

.wa-float {
  position: fixed;
  left: 40px;
  bottom: 30px;
  z-index: 50;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: #25d366;
  color: #ffffff;
  box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.wa-float:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 12px 30px rgba(37, 211, 102, 0.6);
}

.visit-text {
  font-size: 1.15em;
  color: #d4d4d8;
  text-align: right;
  line-height: 1.5;
  letter-spacing: 0.5px;
  margin: 0 0 12px;
  font-weight: 400;
}

.counter {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.9em;
  color: #9ca3af;
  letter-spacing: 2px;
  font-weight: 400;
}

.num {
  color: #ffffff;
  font-weight: 600;
}

.sep {
  color: #52525b;
}

.total {
  color: #71717a;
}

@media (max-width: 900px) {
  .content {
    padding: 0 24px;
  }

  .controls {
    right: 24px;
    bottom: 40px;
  }

  .title {
    font-size: 3em;
  }

  .thumbs-stage {
    --thumb-w: 76px;
    --thumb-h: 56px;
    --thumb-gap: 8px;
  }

  .wa-float {
    left: 24px;
    bottom: 24px;
    width: 50px;
    height: 50px;
  }
}

@media (max-width: 640px) {
  .title {
    font-size: 2.2em;
  }

  .desc {
    font-size: 0.95em;
  }

  .controls {
    right: 16px;
    bottom: 30px;
    gap: 12px;
  }

  .thumbs-stage {
    --thumb-w: 80px;
    --thumb-h: 60px;
    --thumb-gap: 6px;
    --nav-size: 30px;
    gap: 8px;
  }

  .thumb {
    border-radius: 6px;
  }

  .counter {
    font-size: 0.8em;
  }

  .wa-float {
    left: 16px;
    bottom: 16px;
    width: 46px;
    height: 46px;
  }
}
</style>
