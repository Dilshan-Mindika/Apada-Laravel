<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    people: Object,
    filters: Object,
});

const page = usePage();
const trans = computed(() => page.props.translations);

const search = ref(props.filters.search || '');

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

watch(search, debounce((value) => {
    router.get(route('missing-people.index'), { search: value }, { preserveState: true, replace: true });
}, 300));

const markFound = (id) => {
    if (confirm(trans.value.mark_found + '?')) {
        router.post(route('missing-people.found', id));
    }
};
</script>

<template>
    <AppLayout>
        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                            <h2 class="text-2xl font-bold">{{ trans.missing_people }}</h2>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <Link :href="route('missing-people.create')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    {{ trans.report_missing }}
                                </Link>
                                <input v-model="search" type="text" :placeholder="trans.search" class="rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full sm:w-auto bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="person in people.data" :key="person.id" class="border dark:border-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white dark:bg-gray-700">
                                <div class="h-48 bg-gray-200 dark:bg-gray-600 w-full object-cover">
                                    <img v-if="person.image_path" :src="person.image_path" alt="Missing Person" class="h-full w-full object-cover">
                                    <div v-else class="h-full w-full flex items-center justify-center text-gray-500 dark:text-gray-400">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ person.name }}</h3>
                                        <span :class="person.status === 'found' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ person.status === 'found' ? trans.status_found : trans.status_missing }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                        <span class="font-semibold">{{ trans.age }}:</span> {{ person.age || 'N/A' }} | 
                                        <span class="font-semibold">{{ trans.gender }}:</span> {{ person.gender || 'N/A' }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                        <span class="font-semibold">{{ trans.last_seen }}:</span> {{ person.last_seen_location }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">{{ person.description }}</p>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-600">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">{{ trans.contact }}</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ person.contact_name }}</p>
                                        <div class="flex flex-col">
                                            <a :href="'tel:' + person.contact_phone" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">{{ person.contact_phone }}</a>
                                            <a v-if="person.contact_phone_2" :href="'tel:' + person.contact_phone_2" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">{{ person.contact_phone_2 }}</a>
                                        </div>
                                    </div>

                                    <div class="mt-4" v-if="person.status === 'missing'">
                                        <button @click="markFound(person.id)" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900/30 hover:bg-green-200 dark:hover:bg-green-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            {{ trans.mark_found }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6" v-if="people.links.length > 3">
                            <div class="flex justify-center">
                                <template v-for="(link, key) in people.links" :key="key">
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
