<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import type { Destination, DestinationSection } from '@/types';
import DestinationForm from './DestinationForm.vue';

const props = defineProps<{
    destination: Destination & { sections: DestinationSection[] };
}>();

const form = useForm({
    _method: 'PUT',
    name: props.destination.name,
    location: props.destination.location ?? '',
    short_description: props.destination.short_description ?? '',
    description: props.destination.description ?? '',
    image: null as File | null,
    remove_image: false,
    is_active: props.destination.is_active,
    sections: (props.destination.sections ?? []).map((section) => ({
        id: section.id,
        title: section.title,
        description: section.description ?? '',
        image: null as File | null,
        existing_image: section.image,
        remove_image: false,
        preview: section.image,
    })),
});

const submit = () => {
    form.post(`/admin/destinations/${props.destination.id}`);
};
</script>

<template>
    <Head title="Edit Destinasi" />

    <DestinationForm
        v-model:form="form"
        mode="edit"
        title="Edit Destinasi"
        :subtitle="`Perbarui informasi destinasi ${destination.name}`"
        submit-label="Simpan Perubahan"
        cancel-href="/admin/destinations"
        :existing-image="destination.image"
        :on-submit="submit"
    />
</template>
