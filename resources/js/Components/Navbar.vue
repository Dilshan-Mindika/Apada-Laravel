<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const locale = computed(() => page.props.locale);
const trans = computed(() => page.props.translations);

const showingNavigationDropdown = ref(false);

const switchLang = (lang) => {
    window.location.href = route('lang.switch', lang);
};
</script>

<template>
    <nav class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <Link :href="route('home')" class="flex-shrink-0 flex items-center font-bold text-xl text-blue-600">
                        Flood Relief
                    </Link>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <Link :href="route('requests.create')" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out" :class="route().current('requests.create') ? 'border-blue-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'">
                            {{ trans.request_help }}
                        </Link>
                        <Link :href="route('donor.index')" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out" :class="route().current('donor.index') ? 'border-blue-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'">
                            {{ trans.donor_portal }}
                        </Link>
                        <Link :href="route('my-requests.index')" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out" :class="route().current('my-requests.index') ? 'border-blue-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'">
                            {{ trans.my_requests }}
                        </Link>
                        <Link :href="route('missing-people.index')" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out" :class="route().current('missing-people.index') ? 'border-blue-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600'">
                            {{ trans.missing_people }}
                        </Link>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <select :value="locale" @change="switchLang($event.target.value)" class="form-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="en">English</option>
                        <option value="si">සිංහල</option>
                        <option value="ta">தமிழ்</option>
                    </select>
                </div>
                <div class="flex items-center sm:hidden mr-2">
                    <select :value="locale" @change="switchLang($event.target.value)" class="form-select block w-full pl-2 pr-8 py-1 text-sm border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="en">English</option>
                        <option value="si">සිංහල</option>
                        <option value="ta">தமிழ்</option>
                    </select>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <Link :href="route('requests.create')" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium" :class="route().current('requests.create') ? 'border-blue-500 text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/50' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                    {{ trans.request_help }}
                </Link>
                <Link :href="route('donor.index')" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium" :class="route().current('donor.index') ? 'border-blue-500 text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/50' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                    {{ trans.donor_portal }}
                </Link>
                <Link :href="route('my-requests.index')" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium" :class="route().current('my-requests.index') ? 'border-blue-500 text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/50' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                    {{ trans.my_requests }}
                </Link>
                <Link :href="route('missing-people.index')" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium" :class="route().current('missing-people.index') ? 'border-blue-500 text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/50' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600'">
                    {{ trans.missing_people }}
                </Link>
            </div>
        </div>
    </nav>
</template>
