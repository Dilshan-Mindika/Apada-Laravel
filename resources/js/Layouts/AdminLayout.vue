<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);
const showFlash = ref(false);

watch(flashSuccess, (newVal) => {
    if (newVal) {
        showFlash.value = true;
        setTimeout(() => showFlash.value = false, 3000);
    }
});
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Admin Navbar -->
        <nav class="bg-gray-800 dark:bg-gray-900 text-white shadow-lg border-b border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <Link :href="route('admin.dashboard')" class="flex-shrink-0 font-bold text-xl text-white">
                            Admin Dashboard
                        </Link>
                    </div>
                    <div class="flex items-center space-x-4">
                        <Link :href="route('admin.users.index')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Users
                        </Link>
                        <Link :href="route('admin.profile.edit')" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Profile
                        </Link>
                        <Link :href="route('admin.logout')" method="post" as="button" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Logout
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Message -->
        <div v-if="showFlash" class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ flashSuccess }}</span>
            </div>
        </div>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>
