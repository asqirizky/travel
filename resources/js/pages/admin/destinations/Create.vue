<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import DestinationForm from './DestinationForm.vue';

const form = useForm({
    name: '',
    location: '',
    short_description: '',
    description: '',
    image: null as File | null,
    remove_image: false,
    is_active: true,
    sections: [] as Array<{
        id: number | null;
        title: string;
        description: string;
        image: File | null;
        existing_image: string | null;
        remove_image: boolean;
        preview: string | null;
    }>,
});

const submit = () => {
    form.post('/admin/destinations');
};
</script>

<template>
    <Head title="Tambah Destinasi" />

    <DestinationForm
        v-model:form="form"
        mode="create"
        title="Tambah Destinasi"
        subtitle="Lengkapi informasi destinasi beserta sub bab dan fotonya"
        submit-label="Simpan Destinasi"
        cancel-href="/admin/destinations"
        :on-submit="submit"
    />
</template>
