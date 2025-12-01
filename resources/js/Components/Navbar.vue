<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const locale = computed(() => page.props.locale);
const trans = computed(() => page.props.translations);

const switchLang = (lang) => {
    window.location.href = route('lang.switch', lang);
};
</script>

<template>
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <Link :href="route('home')" class="flex-shrink-0 flex items-center font-bold text-xl text-blue-600">
                        Flood Relief
                    </Link>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <Link :href="route('requests.create')" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" :class="route().current('requests.create') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                            {{ trans.request_help }}
                        </Link>
                        <Link :href="route('donor.index')" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" :class="route().current('donor.index') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                            {{ trans.donor_portal }}
                        </Link>
                    </div>
                </div>
                <div class="flex items-center">
                    <select :value="locale" @change="switchLang($event.target.value)" class="form-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="en">English</option>
                        <option value="si">Sinhala</option>
                        <option value="ta">Tamil</option>
                    </select>
                </div>
            </div>
        </div>
    </nav>
</template>
