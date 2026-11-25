<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { useSweetAlert } from '@/sweet-alert/useSweetAlert';

const { title = '', description = '' } = defineProps<{
    title?: string;
    description?: string;
}>();

useSweetAlert();
</script>

<template>
    <AuthLayout :title="title" :description="description">
        <slot />
    </AuthLayout>
</template>
