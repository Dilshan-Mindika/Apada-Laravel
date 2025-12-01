<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const trans = computed(() => page.props.translations);
</script>

<template>
    <AppLayout>
        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ trans.welcome }}</h1>
                    <p class="text-xl text-gray-600">{{ trans.select_role }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <!-- Victim Card -->
                    <Link :href="route('requests.create')" class="group block bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="p-8 text-center">
                            <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors">{{ trans.i_need_help }}</h2>
                            <p class="text-gray-600">{{ trans.request_help_desc }}</p>
                        </div>
                    </Link>

                    <!-- Check Status Card -->
                    <Link :href="route('my-requests.index')" class="group block bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="p-8 text-center">
                            <div class="w-20 h-20 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">{{ trans.check_status }}</h2>
                            <p class="text-gray-600">{{ trans.my_requests }}</p>
                        </div>
                    </Link>

                    <!-- Donor Card -->
                    <Link :href="route('donor.index')" class="group block bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="p-8 text-center">
                            <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">{{ trans.i_want_to_help }}</h2>
                            <p class="text-gray-600">{{ trans.donor_portal_desc }}</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
