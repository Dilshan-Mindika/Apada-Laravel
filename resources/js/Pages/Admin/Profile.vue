<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    current_password: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.patch(route('admin.profile.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset('current_password', 'password', 'password_confirmation'),
    });
};
</script>

<template>
    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-bold mb-6">Profile Management</h2>
                        
                        <form @submit.prevent="submit" class="space-y-6 max-w-xl">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input id="name" v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" v-model="form.email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                            </div>

                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
                                
                                <!-- Current Password -->
                                <div class="mb-4">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                    <input id="current_password" v-model="form.current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <div v-if="form.errors.current_password" class="text-red-500 text-sm mt-1">{{ form.errors.current_password }}</div>
                                </div>

                                <!-- New Password -->
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                    <input id="password" v-model="form.password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                    <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" :disabled="form.processing" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Save Changes
                                </button>

                                <transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
