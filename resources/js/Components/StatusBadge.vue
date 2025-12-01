<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const page = usePage();
const trans = computed(() => page.props.translations);

const classes = computed(() => {
    switch (props.status) {
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'accepted': return 'bg-blue-100 text-blue-800';
        case 'completed': return 'bg-green-100 text-green-800';
        case 'verified': return 'bg-purple-100 text-purple-800';
        default: return 'bg-gray-100 text-gray-800';
    }
});

const label = computed(() => {
    return trans.value[props.status] || props.status;
});
</script>

<template>
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" :class="classes">
        {{ label }}
    </span>
</template>
