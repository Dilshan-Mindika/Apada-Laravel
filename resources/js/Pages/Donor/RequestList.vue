<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import MapLink from '@/Components/MapLink.vue';
import { usePage, router, Link } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    requests: Object,
    filters: Object,
});

const page = usePage();
const trans = computed(() => page.props.translations);

const search = ref(props.filters.search || '');
const category = ref(props.filters.category || 'All');

// Simple debounce implementation
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

watch(search, debounce((value) => {
    router.get(route('donor.index'), { search: value, category: category.value }, { preserveState: true, replace: true });
}, 300));

watch(category, (value) => {
    router.get(route('donor.index'), { search: search.value, category: value }, { preserveState: true, replace: true });
});

const accept = (id) => {
    if (confirm('Are you sure you want to accept this request?')) {
        router.post(route('donor.accept', id));
    }
};

const complete = (id) => {
    if (confirm('Are you sure you want to mark this as completed?')) {
        router.post(route('donor.complete', id));
    }
};
</script>

<template>
    <AppLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between mb-6">
                            <h2 class="text-2xl font-bold">{{ trans.donor_portal }}</h2>
                            <div class="flex space-x-4">
                                <select v-model="category" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="All">{{ trans.all }}</option>
                                    <option value="Food">{{ trans.food }}</option>
                                    <option value="Water">{{ trans.water }}</option>
                                    <option value="Medicine">{{ trans.medicine }}</option>
                                    <option value="Other">{{ trans.other }}</option>
                                </select>
                                <input v-model="search" type="text" :placeholder="trans.search" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ trans.name }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ trans.category }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ trans.location }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="req in requests.data" :key="req.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ req.name }}</div>
                                            <div class="text-sm text-gray-500">{{ req.phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ trans[req.category.toLowerCase()] || req.category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <MapLink :lat="req.lat" :lng="req.lng" />
                                            <div class="text-xs mt-1">{{ req.address }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <StatusBadge :status="req.status" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button v-if="req.status === 'pending'" @click="accept(req.id)" class="text-blue-600 hover:text-blue-900 mr-4">{{ trans.accept }}</button>
                                            <button v-if="req.status === 'accepted'" @click="complete(req.id)" class="text-green-600 hover:text-green-900">{{ trans.complete }}</button>
                                        </td>
                                    </tr>
                                    <tr v-if="requests.data.length === 0">
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">{{ trans.no_requests }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4" v-if="requests.links.length > 3">
                            <div class="flex justify-center">
                                <template v-for="(link, key) in requests.links" :key="key">
                                    <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                                    <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-blue-500 focus:text-blue-500" :class="{ 'bg-blue-600 text-white': link.active }" :href="link.url" v-html="link.label" />
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
