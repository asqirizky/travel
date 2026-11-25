<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, ImagePlus, Plus, Trash2, Upload, X } from '@lucide/vue';
import { ref } from 'vue';

const props = defineProps<{
    mode: 'create' | 'edit';
    title: string;
    subtitle: string;
    submitLabel: string;
    cancelHref: string;
    existingImage?: string | null;
    onSubmit: () => void;
}>();

const form = defineModel<any>('form', { required: true });

const heroPreview = ref<string | null>(props.existingImage ?? null);

const revoke = (url: string | null) => {
    if (url && url.startsWith('blob:')) {
        URL.revokeObjectURL(url);
    }
};

const onHeroChange = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];

    if (!file) {
        return;
    }

    revoke(heroPreview.value);
    form.value.image = file;
    form.value.remove_image = false;
    heroPreview.value = URL.createObjectURL(file);
};

const removeHero = () => {
    revoke(heroPreview.value);
    form.value.image = null;
    form.value.remove_image = props.mode === 'edit';
    heroPreview.value = null;
};

const addSection = () => {
    form.value.sections.push({
        id: null,
        title: '',
        description: '',
        image: null,
        existing_image: null,
        remove_image: false,
        preview: null,
    });
};

const removeSection = (index: number) => {
    revoke(form.value.sections[index].preview);
    form.value.sections.splice(index, 1);
};

const onSectionImageChange = (event: Event, index: number) => {
    const file = (event.target as HTMLInputElement).files?.[0];

    if (!file) {
        return;
    }

    const section = form.value.sections[index];

    revoke(section.preview);
    section.image = file;
    section.remove_image = false;
    section.preview = URL.createObjectURL(file);
};

const removeSectionImage = (index: number) => {
    const section = form.value.sections[index];

    revoke(section.preview);
    section.image = null;
    section.remove_image = Boolean(section.existing_image);
    section.preview = null;
};

const errorFor = (key: string): string | undefined => form.value.errors?.[key];
</script>

<template>
    <div class="mx-auto flex max-w-4xl flex-col space-y-6 p-8">
        <div class="flex items-center gap-4">
            <Link
                :href="cancelHref"
                class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-input bg-background text-sm font-medium shadow-sm hover:bg-accent hover:text-accent-foreground"
            >
                <ArrowLeft class="h-4 w-4" />
            </Link>
            <div>
                <h2 class="text-xl font-bold tracking-tight">{{ title }}</h2>
                <p class="text-sm text-muted-foreground">{{ subtitle }}</p>
            </div>
        </div>

        <form class="space-y-6" @submit.prevent="onSubmit">
            <div class="space-y-6 rounded-lg border bg-card p-6 shadow-sm">
                <div class="flex items-center gap-2 border-b pb-4">
                    <input
                        id="is_active"
                        v-model="form.is_active"
                        type="checkbox"
                        class="h-4 w-4 rounded border-input"
                    />
                    <label for="is_active" class="text-sm font-medium">
                        Aktifkan & tampilkan destinasi ini
                    </label>
                </div>

                <div class="space-y-2">
                    <label class="text-sm leading-none font-medium"
                        >Foto Utama Destinasi</label
                    >

                    <div
                        v-if="heroPreview"
                        class="relative w-full max-w-xs overflow-hidden rounded-md border border-input"
                    >
                        <img
                            :src="heroPreview"
                            alt="Preview"
                            class="h-40 w-full object-cover"
                        />
                        <button
                            type="button"
                            class="absolute top-2 right-2 rounded-full bg-destructive p-1 text-destructive-foreground shadow hover:bg-destructive/90"
                            @click="removeHero"
                        >
                            <X class="h-4 w-4" />
                        </button>
                    </div>

                    <div v-else class="flex w-full items-center justify-center">
                        <label
                            for="destination-image"
                            class="flex h-36 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-input bg-transparent transition-colors hover:bg-accent/50"
                            :class="{ 'border-destructive': form.errors.image }"
                        >
                            <div
                                class="flex flex-col items-center justify-center pt-5 pb-6"
                            >
                                <Upload
                                    class="mb-2 h-8 w-8 text-muted-foreground"
                                />
                                <p class="mb-1 text-sm text-muted-foreground">
                                    <span class="font-semibold"
                                        >Klik untuk upload</span
                                    >
                                    atau drag & drop
                                </p>
                                <p class="text-xs text-muted-foreground">
                                    PNG, JPG, WEBP (Maks. 4MB)
                                </p>
                            </div>
                            <input
                                id="destination-image"
                                type="file"
                                accept="image/*"
                                class="hidden"
                                @change="onHeroChange"
                            />
                        </label>
                    </div>
                    <span
                        v-if="form.errors.image"
                        class="text-xs text-destructive"
                    >
                        {{ form.errors.image }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="space-y-2">
                        <label
                            for="name"
                            class="text-sm leading-none font-medium"
                            >Judul Destinasi</label
                        >
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            placeholder="Contoh: Kawah Ijen"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:ring-1 focus-visible:ring-ring focus-visible:outline-none"
                            :class="{ 'border-destructive': form.errors.name }"
                        />
                        <span
                            v-if="form.errors.name"
                            class="text-xs text-destructive"
                        >
                            {{ form.errors.name }}
                        </span>
                    </div>

                    <div class="space-y-2">
                        <label
                            for="location"
                            class="text-sm leading-none font-medium"
                            >Lokasi</label
                        >
                        <input
                            id="location"
                            v-model="form.location"
                            type="text"
                            placeholder="Contoh: Banyuwangi"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:ring-1 focus-visible:ring-ring focus-visible:outline-none"
                            :class="{
                                'border-destructive': form.errors.location,
                            }"
                        />
                        <span
                            v-if="form.errors.location"
                            class="text-xs text-destructive"
                        >
                            {{ form.errors.location }}
                        </span>
                    </div>
                </div>

                <div class="space-y-2">
                    <label
                        for="short_description"
                        class="text-sm leading-none font-medium"
                    >
                        Deskripsi Singkat
                    </label>
                    <textarea
                        id="short_description"
                        v-model="form.short_description"
                        rows="2"
                        placeholder="Ringkasan singkat yang tampil pada banner destinasi."
                        class="flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:ring-1 focus-visible:ring-ring focus-visible:outline-none"
                        :class="{
                            'border-destructive': form.errors.short_description,
                        }"
                    ></textarea>
                    <span
                        v-if="form.errors.short_description"
                        class="text-xs text-destructive"
                    >
                        {{ form.errors.short_description }}
                    </span>
                </div>

                <div class="space-y-2">
                    <label
                        for="description"
                        class="text-sm leading-none font-medium"
                    >
                        Deskripsi Destinasi
                    </label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="5"
                        placeholder="Ceritakan gambaran umum destinasi ini."
                        class="flex min-h-[120px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:ring-1 focus-visible:ring-ring focus-visible:outline-none"
                        :class="{
                            'border-destructive': form.errors.description,
                        }"
                    ></textarea>
                    <span
                        v-if="form.errors.description"
                        class="text-xs text-destructive"
                    >
                        {{ form.errors.description }}
                    </span>
                </div>
            </div>

            <div class="space-y-4 rounded-lg border bg-card p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-base font-semibold">
                            Sub Bab Destinasi
                        </h3>
                        <p class="text-sm text-muted-foreground">
                            Tambahkan bagian informasi secara bebas, lengkap
                            dengan foto pendukung.
                        </p>
                    </div>
                    <button
                        type="button"
                        class="inline-flex items-center gap-1.5 rounded-md border border-input bg-background px-3 py-2 text-sm font-medium shadow-sm hover:bg-accent hover:text-accent-foreground"
                        @click="addSection"
                    >
                        <Plus class="h-4 w-4" />
                        Tambah Sub Bab
                    </button>
                </div>

                <div
                    v-if="form.sections.length === 0"
                    class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-input py-10 text-center"
                >
                    <ImagePlus class="mb-2 h-8 w-8 text-muted-foreground" />
                    <p class="text-sm text-muted-foreground">
                        Belum ada sub bab. Klik "Tambah Sub Bab" untuk mulai.
                    </p>
                </div>

                <div class="space-y-4">
                    <div
                        v-for="(section, index) in form.sections"
                        :key="index"
                        class="rounded-lg border bg-background/40 p-4"
                    >
                        <div class="mb-4 flex items-center justify-between">
                            <span class="text-sm font-semibold"
                                >Sub Bab {{ index + 1 }}</span
                            >
                            <button
                                type="button"
                                class="inline-flex items-center gap-1 rounded-md px-2 py-1 text-xs font-medium text-destructive hover:bg-destructive/10"
                                @click="removeSection(index)"
                            >
                                <Trash2 class="h-3.5 w-3.5" />
                                Hapus
                            </button>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-4 md:grid-cols-[180px_1fr]"
                        >
                            <div class="space-y-2">
                                <label class="text-sm leading-none font-medium"
                                    >Foto Sub Bab</label
                                >

                                <div
                                    v-if="section.preview"
                                    class="relative w-full overflow-hidden rounded-md border border-input"
                                >
                                    <img
                                        :src="section.preview"
                                        alt="Preview sub bab"
                                        class="h-28 w-full object-cover"
                                    />
                                    <button
                                        type="button"
                                        class="absolute top-1.5 right-1.5 rounded-full bg-destructive p-1 text-destructive-foreground shadow hover:bg-destructive/90"
                                        @click="removeSectionImage(index)"
                                    >
                                        <X class="h-3 w-3" />
                                    </button>
                                </div>

                                <label
                                    v-else
                                    :for="`section-image-${index}`"
                                    class="flex h-28 w-full cursor-pointer flex-col items-center justify-center rounded-md border-2 border-dashed border-input transition-colors hover:bg-accent/50"
                                >
                                    <Upload
                                        class="mb-1 h-6 w-6 text-muted-foreground"
                                    />
                                    <span class="text-xs text-muted-foreground"
                                        >Upload foto</span
                                    >
                                    <input
                                        :id="`section-image-${index}`"
                                        type="file"
                                        accept="image/*"
                                        class="hidden"
                                        @change="
                                            onSectionImageChange($event, index)
                                        "
                                    />
                                </label>
                                <span
                                    v-if="errorFor(`sections.${index}.image`)"
                                    class="text-xs text-destructive"
                                >
                                    {{ errorFor(`sections.${index}.image`) }}
                                </span>
                            </div>

                            <div class="space-y-3">
                                <div class="space-y-2">
                                    <label
                                        class="text-sm leading-none font-medium"
                                        >Judul Sub Bab</label
                                    >
                                    <input
                                        v-model="section.title"
                                        type="text"
                                        placeholder="Contoh: Sejarah Singkat"
                                        class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:ring-1 focus-visible:ring-ring focus-visible:outline-none"
                                        :class="{
                                            'border-destructive': errorFor(
                                                `sections.${index}.title`,
                                            ),
                                        }"
                                    />
                                    <span
                                        v-if="
                                            errorFor(`sections.${index}.title`)
                                        "
                                        class="text-xs text-destructive"
                                    >
                                        {{
                                            errorFor(`sections.${index}.title`)
                                        }}
                                    </span>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-sm leading-none font-medium"
                                        >Deskripsi Sub Bab</label
                                    >
                                    <textarea
                                        v-model="section.description"
                                        rows="4"
                                        placeholder="Tuliskan penjelasan untuk sub bab ini."
                                        class="flex min-h-[96px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:ring-1 focus-visible:ring-ring focus-visible:outline-none"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span
                    v-if="form.errors.sections"
                    class="text-xs text-destructive"
                >
                    {{ form.errors.sections }}
                </span>
            </div>

            <div class="flex items-center justify-end gap-3">
                <Link
                    :href="cancelHref"
                    class="inline-flex items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm hover:bg-accent hover:text-accent-foreground"
                >
                    Batal
                </Link>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90 disabled:opacity-50"
                >
                    {{ form.processing ? 'Menyimpan...' : submitLabel }}
                </button>
            </div>
        </form>
    </div>
</template>
