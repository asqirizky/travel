<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Destinations from '@/landing/components/Destinations.vue';
import LandingHero from '@/landing/components/Landing.vue';
import Packages from '@/landing/components/Packages.vue';
import Testimonial from '@/landing/components/Testimonial.vue';
import WhyTravelWithUs from '@/landing/components/WhyTravelWithUs.vue';
import type { Destination, Package } from '@/types';

defineProps<{
    packages: Package[];
    destinations: Destination[];
}>();
</script>

<template>
    <Head title="Indonesia Culture Trip" />

    <LandingHero />
    <Destinations :destinations="destinations" />
    <WhyTravelWithUs />
    <Packages :packages="packages" />
    <Testimonial />
</template>
