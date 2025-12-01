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

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
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
                    <!-- Missing People Card -->
                    <Link :href="route('missing-people.index')" class="group block bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="p-8 text-center">
                            <div class="w-20 h-20 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-yellow-600 transition-colors">{{ trans.find_missing_people }}</h2>
                            <p class="text-gray-600">{{ trans.missing_desc }}</p>
                        </div>
                    </Link>
                </div>



                <!-- Emergency Hotlines Section -->
                <div class="mt-16 max-w-5xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-red-100">
                        <div class="bg-red-600 px-6 py-4">
                            <div class="flex items-center justify-center">
                                <svg class="h-8 w-8 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <h3 class="ml-3 text-2xl font-bold text-white">{{ trans.emergency_hotlines }}</h3>
                            </div>
                        </div>
                        
                        <div class="p-8">
                            <p class="text-center text-gray-600 mb-8 max-w-3xl mx-auto text-lg">{{ trans.emergency_desc }}</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- 117 Hotline - Primary -->
                                <a href="tel:117" class="flex flex-col items-center justify-center p-6 bg-red-50 rounded-xl border-2 border-red-100 hover:border-red-300 hover:shadow-lg transition-all duration-300 group">
                                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <span class="text-4xl font-black text-red-600 mb-2">117</span>
                                    <span class="text-sm font-medium text-gray-600 text-center">{{ trans.hotline_24h }}</span>
                                </a>

                                <!-- Colombo Hotline -->
                                <a href="tel:0112434028" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl border-2 border-gray-100 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                                    <div class="w-12 h-12 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800 mb-2">011-2434028</span>
                                    <span class="text-sm font-medium text-gray-600 text-center">{{ trans.hotline_colombo }}</span>
                                </a>

                                <!-- DMC Hotline -->
                                <a href="tel:0112136136" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl border-2 border-gray-100 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group">
                                    <div class="w-12 h-12 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800 mb-2">011-2136136</span>
                                    <span class="text-sm font-medium text-gray-600 text-center">{{ trans.hotline_dmc }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
