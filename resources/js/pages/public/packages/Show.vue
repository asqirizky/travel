<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, MapPin, Clock } from '@lucide/vue';

interface Package {
    id: number;
    name_package: string;
    slug: string;
    location: string;
    short_description: string;
    duration_days: number;
    duration_nights: number;
    thumbnail: string | null;
    is_active: boolean;
    created_at: string;
}

const props = defineProps<{
    package: Package;
    whatsappNumber: string;
}>();

const customerName = ref('');
const travelDate = ref('');
const participantCount = ref(1);

const sendToWhatsApp = () => {
    if (!customerName.value || !travelDate.value) {
        alert('Mohon isi nama dan tanggal keberangkatan.');
        return;
    }

    const message = `Halo Admin, saya ingin memesan paket wisata berikut:

📌 *Paket:* ${props.package.name_package}
📍 *Lokasi:* ${props.package.location}
🗓️ *Tgl Keberangkatan:* ${travelDate.value}
👤 *Jumlah Peserta:* ${participantCount.value} Orang

*Data Pemesan:*
• *Nama:* ${customerName.value}

Mohon informasi ketersediaan slot dan langkah pembayaran selanjutnya. Terima kasih!`;

    const encodedMessage = encodeURIComponent(message);
    const waUrl = `https://wa.me/${props.whatsappNumber}?text=${encodedMessage}`;
    window.open(waUrl, '_blank');
};
</script>

<template>
    <Head :title="`${package.name_package} - Detail Paket`" />

    <div class="min-h-screen bg-slate-950 text-slate-100">
        <!-- Hero Banner Full Width -->
        <div class="relative h-[80vh] min-h-[560px] w-full overflow-hidden">
            <img
                :src="
                    package.thumbnail ||
                    'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=1400&q=80'
                "
                :alt="package.name_package"
                class="absolute inset-0 h-full w-full object-cover"
            />
            <div
                class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-slate-950"
            ></div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-transparent"
            ></div>

            <!-- Top Nav (overlaid, below navbar) -->
            <div class="absolute top-[86px] right-0 left-0 z-50 px-6">
                <div
                    class="mx-auto flex max-w-6xl items-center justify-between"
                >
                    <Link
                        href="/"
                        class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-medium text-white backdrop-blur-md transition-all hover:bg-white/20"
                    >
                        <ArrowLeft class="h-3.5 w-3.5" /> Back
                    </Link>
                </div>
            </div>

            <!-- Title & Info at Bottom -->
            <div class="absolute right-0 bottom-0 left-0 z-10">
                <div class="mx-auto max-w-6xl px-6 pb-12">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="rounded-full border border-violet-400/20 bg-violet-500/15 px-3 py-1 text-[11px] font-bold tracking-[3px] text-violet-300 uppercase backdrop-blur-md"
                        >
                            {{ package.location }}
                        </span>
                        <span
                            class="rounded-full border border-emerald-400/20 bg-emerald-500/15 px-3 py-1 text-[11px] font-bold tracking-[3px] text-emerald-300 uppercase backdrop-blur-md"
                        >
                            {{ package.duration_days }} Day /
                            {{ package.duration_nights }} Night
                        </span>
                    </div>
                    <h1
                        class="text-3xl leading-[1.1] font-extrabold tracking-tight text-white md:text-4xl"
                    >
                        {{ package.name_package }}
                    </h1>
                </div>
                <div
                    class="h-24 bg-gradient-to-t from-slate-950 to-transparent"
                ></div>
            </div>
        </div>

        <!-- Main Content -->
        <div
            class="relative z-20 mx-auto -mt-6 grid max-w-6xl grid-cols-1 gap-8 px-6 pb-24 lg:grid-cols-3"
        >
            <!-- Left Column -->
            <div class="space-y-8 lg:col-span-3">
                <!-- Highlight Stats -->
                <div
                    class="mx-auto max-w-5xl w-full grid grid-cols-2 gap-6 rounded-2xl border border-slate-800/80 bg-slate-900/80 p-6 backdrop-blur-sm"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="rounded-xl border border-violet-500/20 bg-violet-500/10 p-2.5 text-violet-400"
                        >
                            <Clock class="h-5 w-5" />
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-semibold tracking-wider text-slate-500 uppercase"
                            >
                                Duration
                            </p>
                            <p class="text-sm font-bold text-slate-100 leading-none">
                                {{ package.duration_days }} Day /
                                {{ package.duration_nights }} Night
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-3 border-l border-slate-800/80 pl-4"
                    >
                        <div
                            class="rounded-xl border border-violet-500/20 bg-violet-500/10 p-2.5 text-violet-400"
                        >
                            <MapPin class="h-5 w-5" />
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-semibold tracking-wider text-slate-500 uppercase"
                            >
                                Destination
                            </p>
                            <p
                                class="truncate text-sm font-bold text-slate-100"
                            >
                                {{ package.location }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="mx-auto max-w-5xl w-full space-y-4 text-start">
                    <div class="flex items-start justify-start gap-2">
                        <div class="h-8 w-8 rounded-xl bg-violet-500/10 flex items-center justify-center text-violet-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">Package Summary</h3>
                    </div>
                    <p
                        class="rounded-2xl border border-slate-800/50 bg-slate-900/40 p-8 text-[15px] leading-relaxed whitespace-pre-line text-slate-300/90 w-full"
                    >
                        {{ package.short_description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
