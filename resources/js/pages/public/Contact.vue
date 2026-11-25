<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    ArrowRight,
    CalendarDays,
    MapPin,
    MessageCircle,
    Sparkles,
    Users,
} from '@lucide/vue';
import { computed, reactive } from 'vue';

const props = defineProps<{
    whatsappNumber: string;
}>();

const form = reactive({
    name: '',
    dates: '',
    destination: '',
    travelers: '',
    notes: '',
});

const directWhatsappUrl = computed(
    () =>
        `https://wa.me/${props.whatsappNumber}?text=${encodeURIComponent('Halo Ijen Bromo Travel, saya ingin mulai merencanakan perjalanan.')}`,
);

const whatsappUrl = computed(() => {
    const message = [
        'Halo Ijen Bromo Travel, saya ingin mulai merencanakan perjalanan.',
        '',
        `Nama: ${form.name}`,
        `Tanggal rencana: ${form.dates || '-'}`,
        `Destinasi: ${form.destination || '-'}`,
        `Jumlah traveler: ${form.travelers || '-'}`,
        `Catatan: ${form.notes || '-'}`,
    ].join('\n');

    return `https://wa.me/${props.whatsappNumber}?text=${encodeURIComponent(message)}`;
});

function submitForm(): void {
    window.open(whatsappUrl.value, '_blank', 'noopener,noreferrer');
}
</script>

<template>
    <Head title="Start Planning - Ijen Bromo Travel" />

    <section class="plan-page">
        <div class="plan-hero">
            <div class="plan-hero-bg"></div>
            <div class="plan-hero-overlay"></div>

            <div class="plan-hero-inner">
                <span class="plan-badge">
                    <Sparkles :size="14" :stroke-width="2" />
                    Start Planning
                </span>
                <h1 class="plan-title">Let's plan your trip.</h1>
                <p class="plan-desc">
                    Tell us a little about the journey you have in mind. We'll
                    continue the conversation on WhatsApp and shape the details
                    together.
                </p>
            </div>
        </div>

        <div class="plan-body">
            <div class="plan-content">
                <aside class="plan-aside">
                    <div class="wa-card">
                        <span class="wa-icon">
                            <MessageCircle :size="24" :stroke-width="1.8" />
                        </span>
                        <h2>Chat with us directly</h2>
                        <p>
                            Prefer to just talk? Send us a message and our local
                            team will reply with ideas, availability, and a
                            price estimate.
                        </p>
                        <div class="wa-number">+62 812-1690-4379</div>
                        <a
                            :href="directWhatsappUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="wa-link"
                        >
                            Open WhatsApp
                            <ArrowRight :size="16" :stroke-width="2" />
                        </a>
                    </div>

                    <div class="plan-points">
                        <div class="plan-point">
                            <CalendarDays :size="18" :stroke-width="1.8" />
                            <span>Share your travel dates</span>
                        </div>
                        <div class="plan-point">
                            <MapPin :size="18" :stroke-width="1.8" />
                            <span>Tell us where you want to go</span>
                        </div>
                        <div class="plan-point">
                            <Users :size="18" :stroke-width="1.8" />
                            <span>We plan around your group</span>
                        </div>
                    </div>
                </aside>

                <form class="plan-form" @submit.prevent="submitForm">
                    <div class="plan-form-head">
                        <h2>Trip details</h2>
                        <p>
                            Fill this in and we'll send it straight to WhatsApp.
                        </p>
                    </div>

                    <label class="field">
                        <span>Your name</span>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="e.g. Rina"
                            required
                        />
                    </label>

                    <div class="field-row">
                        <label class="field">
                            <span>Travel dates</span>
                            <input
                                v-model="form.dates"
                                type="text"
                                placeholder="e.g. 12-15 June"
                            />
                        </label>
                        <label class="field">
                            <span>Travelers</span>
                            <input
                                v-model="form.travelers"
                                type="text"
                                inputmode="numeric"
                                placeholder="e.g. 2 people"
                            />
                        </label>
                    </div>

                    <label class="field">
                        <span>Destination</span>
                        <input
                            v-model="form.destination"
                            type="text"
                            placeholder="e.g. Bromo, Ijen, Bali"
                        />
                    </label>

                    <label class="field">
                        <span>Anything else?</span>
                        <textarea
                            v-model="form.notes"
                            rows="4"
                            placeholder="Budget, interests, or questions for us"
                        ></textarea>
                    </label>

                    <button type="submit" class="plan-submit">
                        Continue on WhatsApp
                        <ArrowRight :size="16" :stroke-width="2" />
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>

<style scoped>
.plan-page {
    position: relative;
    background: #f8fafc;
    overflow: hidden;
}

.plan-hero {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 70vh;
    padding: 150px 20px 120px;
    overflow: hidden;
}

.plan-hero-bg {
    position: absolute;
    inset: 0;
    background: url('/destinations/the-charm-of-bromo-from-the-land-above-k32VszSw.jpg')
        center / cover no-repeat;
    z-index: 0;
}

.plan-hero-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            to bottom,
            rgba(2, 6, 23, 0.42) 0%,
            rgba(2, 6, 23, 0.5) 50%,
            rgba(15, 23, 42, 0.86) 82%,
            #202020 100%
        );
    z-index: 1;
}

.plan-hero-inner {
    position: relative;
    z-index: 2;
    max-width: 640px;
    text-align: center;
}

.plan-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.72em;
    color: #bbf7d0;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-weight: 600;
    margin-bottom: 20px;
    padding: 7px 18px;
    border-radius: 100px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.22);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.plan-title {
    font-size: 3.2em;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.14;
    letter-spacing: -1.6px;
    margin: 0 0 20px;
    text-shadow: 0 6px 40px rgba(2, 6, 23, 0.6);
}

.plan-desc {
    font-size: 1em;
    line-height: 1.85;
    color: #e2e8f0;
    margin: 0;
    text-shadow: 0 2px 18px rgba(2, 6, 23, 0.6);
}

.plan-body {
    position: relative;
    z-index: 2;
    max-width: 1080px;
    margin: 0 auto;
    padding: 40px 20px 100px;
}

.plan-content {
    display: grid;
    grid-template-columns: minmax(0, 0.85fr) minmax(0, 1.15fr);
    align-items: start;
    gap: 28px;
}

.plan-aside {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.wa-card,
.plan-form {
    border: 1px solid rgba(15, 23, 42, 0.07);
    border-radius: 20px;
    background: #ffffff;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.07);
}

.wa-card {
    padding: 30px;
}

.wa-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 14px;
    color: #16a34a;
    background: #f0fdf4;
    border: 1px solid rgba(22, 163, 74, 0.14);
    margin-bottom: 22px;
}

.wa-card h2,
.plan-form-head h2 {
    font-size: 1.2em;
    font-weight: 600;
    color: #0f172a;
    letter-spacing: -0.3px;
    margin: 0 0 10px;
}

.wa-card p,
.plan-form-head p {
    font-size: 0.88em;
    line-height: 1.8;
    color: #64748b;
    margin: 0;
}

.wa-number {
    font-size: 1.15em;
    font-weight: 600;
    color: #0f172a;
    letter-spacing: 0.2px;
    margin: 26px 0 18px;
}

.wa-link,
.plan-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 22px;
    border-radius: 100px;
    font-size: 0.88em;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    font-family: inherit;
    transition:
        transform 0.3s ease,
        background 0.3s ease,
        box-shadow 0.3s ease;
}

.wa-link {
    color: #ffffff;
    background: #16a34a;
    box-shadow: 0 12px 28px rgba(22, 163, 74, 0.24);
}

.wa-link:hover,
.plan-submit:hover {
    transform: translateY(-2px);
}

.wa-link:hover {
    background: #15803d;
}

.plan-points {
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 6px 8px;
}

.plan-point {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.84em;
    color: #475569;
}

.plan-point svg {
    flex-shrink: 0;
    color: #16a34a;
}

.plan-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 32px;
}

.plan-form-head {
    margin-bottom: 4px;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.field > span {
    font-size: 0.78em;
    font-weight: 500;
    color: #475569;
}

.field input,
.field textarea {
    width: 100%;
    box-sizing: border-box;
    padding: 13px 16px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    color: #0f172a;
    font-size: 0.9em;
    font-family: inherit;
    outline: none;
    resize: vertical;
    transition:
        border-color 0.3s ease,
        box-shadow 0.3s ease;
}

.field input:focus,
.field textarea:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
}

.field input::placeholder,
.field textarea::placeholder {
    color: #94a3b8;
}

.field-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
}

.plan-submit {
    align-self: flex-start;
    color: #ffffff;
    background: #16a34a;
    box-shadow: 0 12px 28px rgba(22, 163, 74, 0.24);
}

.plan-submit:hover {
    background: #15803d;
}

@media (max-width: 900px) {
    .plan-hero {
        min-height: 62vh;
        padding: 120px 20px 100px;
    }

    .plan-title {
        font-size: 2.5em;
    }

    .plan-body {
        padding: 24px 16px 70px;
    }

    .plan-content {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .plan-title {
        font-size: 2em;
        letter-spacing: -1px;
    }

    .wa-card,
    .plan-form {
        padding: 24px 20px;
    }

    .field-row {
        grid-template-columns: 1fr;
    }

    .wa-link,
    .plan-submit {
        width: 100%;
    }
}
</style>
