<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { Layers, MapPin, Pencil, Plus, Trash2 } from '@lucide/vue';
import { ref } from 'vue';
import Heading from '@/components/Heading.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { create, destroy, edit, index } from '@/routes/admin/destinations';
import type { Destination } from '@/types';

defineProps<{
    destinations: Destination[];
}>();

const deleteDialogOpen = ref(false);
const destinationToDelete = ref<Destination | null>(null);

const confirmDelete = (destination: Destination) => {
    destinationToDelete.value = destination;
    deleteDialogOpen.value = true;
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Manajemen Destinasi',
                href: index(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Manajemen Destinasi" />

    <div class="flex flex-col space-y-6 p-8">
        <div class="flex items-center justify-between">
            <Heading
                variant="small"
                title="Manajemen Destinasi"
                description="Kelola destinasi wisata, foto, dan sub bab informasinya"
            />

            <Button as-child>
                <Link :href="create()">
                    <Plus class="mr-1 h-4 w-4" /> Tambah Destinasi
                </Link>
            </Button>
        </div>

        <div class="space-y-3">
            <div
                v-for="item in destinations"
                :key="item.id"
                class="flex items-center justify-between gap-4 rounded-lg border p-4"
            >
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-md bg-muted text-sm font-medium"
                    >
                        <img
                            v-if="item.image"
                            :src="item.image"
                            :alt="item.name"
                            class="h-full w-full object-cover"
                        />
                        <MapPin v-else class="h-5 w-5 text-muted-foreground" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-base font-medium">{{
                                item.name
                            }}</span>
                            <Badge
                                :variant="
                                    item.is_active ? 'default' : 'secondary'
                                "
                            >
                                {{ item.is_active ? 'Aktif' : 'Draft' }}
                            </Badge>
                        </div>
                        <div
                            class="mt-1 flex items-center gap-3 text-xs text-muted-foreground"
                        >
                            <span
                                v-if="item.location"
                                class="flex items-center gap-1"
                            >
                                <MapPin class="h-3 w-3" /> {{ item.location }}
                            </span>
                            <span class="flex items-center gap-1">
                                <Layers class="h-3 w-3" />
                                {{ item.sections_count ?? 0 }} sub bab
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="edit(item.id)">
                            <Pencil class="h-4 w-4" />
                        </Link>
                    </Button>

                    <Button
                        variant="ghost"
                        size="sm"
                        @click="confirmDelete(item)"
                    >
                        <Trash2 class="h-4 w-4" />
                    </Button>
                </div>
            </div>

            <p
                v-if="destinations.length === 0"
                class="py-8 text-center text-muted-foreground"
            >
                Belum ada destinasi terdaftar.
            </p>
        </div>
    </div>

    <Dialog :open="deleteDialogOpen" @update:open="deleteDialogOpen = $event">
        <DialogContent>
            <Form
                v-if="destinationToDelete"
                v-bind="destroy.form(destinationToDelete.id)"
                v-slot="{ processing }"
            >
                <DialogHeader>
                    <DialogTitle>Hapus Destinasi</DialogTitle>
                    <DialogDescription>
                        Apakah Anda yakin ingin menghapus destinasi "{{
                            destinationToDelete.name
                        }}"? Semua sub bab dan fotonya juga akan dihapus.
                    </DialogDescription>
                </DialogHeader>

                <DialogFooter class="mt-4 gap-2">
                    <DialogClose as-child>
                        <Button variant="secondary"> Batal </Button>
                    </DialogClose>

                    <Button
                        type="submit"
                        variant="destructive"
                        :disabled="processing"
                    >
                        Hapus
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>
