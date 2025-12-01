<script setup>
import Navbar from '@/Components/Navbar.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);
const trans = computed(() => page.props.translations);

const showFlash = ref(false);

watch(flashSuccess, (newVal) => {
    if (newVal) {
        showFlash.value = true;
        setTimeout(() => showFlash.value = false, 3000);
    }
});
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <Navbar />

        <div v-if="showFlash" class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ trans[flashSuccess] || flashSuccess }}</span>
            </div>
        </div>

        <main>
            <slot />
        </main>
    </div>
</template>
