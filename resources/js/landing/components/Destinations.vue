<template>
    <section class="destinations">
        <div class="container">
            <h2 class="section-title">Best Destination</h2>
            <p class="section-subtitle">
                Discover the beauty of thousands of islands
            </p>

            <div v-if="items.length" class="list">
                <Link
                    v-for="item in items"
                    :key="item.id"
                    :href="`/destinations/${item.slug}`"
                    class="item"
                    :class="{ 'no-image': !item.image }"
                    @mouseenter="hoveredId = item.id"
                    @mouseleave="hoveredId = null"
                >
                    <img
                        v-if="item.image"
                        :src="item.image"
                        :alt="item.name"
                        loading="lazy"
                    />
                    <span class="see-more"
                        >See more <span class="arrow">→</span></span
                    >
                    <div class="info">
                        <h3>{{ displayName(item) }}</h3>
                        <span v-if="item.location">{{ item.location }}</span>
                    </div>
                </Link>
            </div>

            <p v-else class="empty">Belum ada destinasi yang ditampilkan.</p>
        </div>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import type { Destination } from '@/types';

const props = defineProps<{
    destinations?: Destination[];
}>();

const items = computed(() => props.destinations ?? []);

const hoveredId = ref<number | null>(null);
const canHover = ref(true);

onMounted(() => {
    canHover.value = window.matchMedia('(hover: hover)').matches;
});

const displayName = (item: Destination): string => {
    if (!canHover.value || hoveredId.value === item.id) {
        return item.name;
    }

    const words = item.name.trim().split(/\s+/);

    return words.length > 3
        ? `${words.slice(0, 3).join(' ')}...`
        : words.join(' ');
};
</script>

<style scoped>
.destinations {
    position: relative;
    padding: 100px 20px;
    background: #ffffff;
    overflow: hidden;
}

.container {
    position: relative;
    z-index: 1;
    max-width: 900px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    font-size: 2.5em;
    color: rgb(0, 0, 0);
    margin-bottom: 8px;
}

.section-subtitle {
    text-align: center;
    font-size: 1.1em;
    color: #cbd5e1;
    margin-bottom: 50px;
}

.empty {
    text-align: center;
    color: #64748b;
}

.list {
    display: flex;
    flex-direction: row;
    gap: 0;
    border-radius: 12px;
    overflow: hidden;
}

.item {
    position: relative;
    display: block;
    flex: 1;
    height: 450px;
    overflow: hidden;
    cursor: pointer;
    transition:
        flex 0.5s ease,
        filter 0.4s ease,
        z-index 0s;
    z-index: 1;
    text-decoration: none;
    color: inherit;
    background: #f8fafc;
}

.list:hover .item {
    flex: 0.4;
}

.list .item:hover {
    flex: 2.8;
    z-index: 10;
    filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.15));
}

.item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: filter 0.4s ease;
}

.list:hover .item img {
    filter: brightness(0.9);
}

.list .item:hover img {
    filter: brightness(1);
}

.item::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.35), transparent);
    pointer-events: none;
}

.see-more {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 999px;
    border: 1px solid rgba(59, 130, 246, 0.5);
    background: rgba(15, 23, 42, 0.25);
    backdrop-filter: blur(6px);
    color: #0f172a;
    font-size: 0.85em;
    font-weight: 500;
    letter-spacing: 0.3px;
    opacity: 0;
    transform: translateY(-8px);
    transition:
        opacity 0.35s ease,
        transform 0.35s ease,
        background 0.35s ease;
    pointer-events: none;
}

.see-more .arrow {
    transition: transform 0.35s ease;
}

.item:hover .see-more {
    opacity: 1;
    transform: translateY(0);
}

.item:hover .see-more .arrow {
    transform: translateX(3px);
}

.item:hover .see-more {
    background: rgba(59, 130, 246, 0.85);
    color: #ffffff;
}

.info {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 30px;
    z-index: 2;
    transition: opacity 0.3s ease;
}

.list:hover .item:not(:hover) .info {
    opacity: 0;
}

.info h3 {
    font-size: 1.6em;
    color: #ffffff;
    margin: 0 0 4px;
    font-weight: 500;
}

.info span {
    font-size: 0.85em;
    color: #d1d1d1;
    letter-spacing: 1px;
    text-transform: uppercase;
}

@media (max-width: 900px) {
    .list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        border-radius: 0;
        overflow: visible;
    }

    .item {
        border-radius: 12px;
        height: 300px;
        flex: none;
        filter: none;
    }

    .item img {
        filter: brightness(1);
    }

    .list:hover .item,
    .list .item:hover {
        flex: none;
        filter: none;
    }

    .list:hover .item img,
    .list .item:hover img {
        filter: brightness(1);
    }

    .item:hover img {
        transform: scale(1.05);
    }

    .list:hover .item:not(:hover) .info {
        opacity: 1;
    }

    .see-more {
        opacity: 1;
        transform: translateY(0);
        top: 14px;
        right: 14px;
        padding: 6px 12px;
    }
}

@media (max-width: 640px) {
    .destinations {
        padding: 50px 16px;
    }

    .section-title {
        font-size: 1.8em;
    }

    .list {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .item {
        height: 250px;
    }
}
</style>
