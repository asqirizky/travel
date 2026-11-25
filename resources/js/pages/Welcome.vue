<script setup lang="ts">
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
    <LandingHero />
    <Destinations :destinations="destinations" />
    <WhyTravelWithUs />
    <Packages :packages="packages" />
    <Testimonial />
</template>
