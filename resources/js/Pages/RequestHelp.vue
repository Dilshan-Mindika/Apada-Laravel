<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const trans = computed(() => page.props.translations);

const form = useForm({
    name: '',
    phone: '',
    address: '',
    category: 'Food',
    remarks: '',
    lat: null,
    lng: null,
});

const getLocation = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            form.lat = position.coords.latitude;
            form.lng = position.coords.longitude;
        }, (error) => {
            alert('Error getting location: ' + error.message);
        });
    } else {
        alert('Geolocation is not supported by this browser.');
    }
};

const submit = () => {
    form.post(route('requests.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout>
        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-2xl font-bold mb-6">{{ trans.request_help }}</h2>

                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ trans.name }}</label>
                                    <input v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ trans.phone }}</label>
                                    <input v-model="form.phone" type="text" placeholder="07xxxxxxxx" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                    <div v-if="form.errors.phone" class="text-red-500 text-sm mt-1">{{ form.errors.phone }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ trans.address }}</label>
                                    <textarea v-model="form.address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 placeholder-gray-500 dark:placeholder-gray-400"></textarea>
                                    <div v-if="form.errors.address" class="text-red-500 text-sm mt-1">{{ form.errors.address }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ trans.category }}</label>
                                    <select v-model="form.category" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3">
                                        <option value="Food">{{ trans.food }}</option>
                                        <option value="Water">{{ trans.water }}</option>
                                        <option value="Medicine">{{ trans.medicine }}</option>
                                        <option value="Clothes">{{ trans.clothes }}</option>
                                        <option value="Transport">{{ trans.transport }}</option>
                                        <option value="Sanitary">{{ trans.sanitary }}</option>
                                        <option value="Other">{{ trans.other }}</option>
                                    </select>
                                    <div v-if="form.errors.category" class="text-red-500 text-sm mt-1">{{ form.errors.category }}</div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ trans.remarks }}</label>
                                    <textarea v-model="form.remarks" rows="2" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-3 placeholder-gray-500 dark:placeholder-gray-400"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ trans.location }}</label>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <button type="button" @click="getLocation" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Get Current Location
                                        </button>
                                        <div v-if="form.lat" class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ form.lat.toFixed(6) }}, {{ form.lng.toFixed(6) }}
                                        </div>
                                    </div>
                                    <div v-if="form.errors.lat" class="text-red-500 text-sm mt-1">{{ trans.location }} is required (or manual input)</div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" :disabled="form.processing" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        {{ trans.submit }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
