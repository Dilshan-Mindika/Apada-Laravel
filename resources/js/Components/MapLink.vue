<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    lat: [Number, String],
    lng: [Number, String],
});

const page = usePage();
const trans = computed(() => page.props.translations);

const url = computed(() => `https://maps.google.com/?q=${props.lat},${props.lng}`);
</script>

<template>
    <a v-if="lat && lng" :href="url" target="_blank" class="text-blue-600 hover:text-blue-900">
        {{ trans.view_map }}
    </a>
    <span v-else class="text-gray-400">-</span>
</template>
