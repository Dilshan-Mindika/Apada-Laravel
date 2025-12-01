<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const trans = computed(() => page.props.translations);

const form = useForm({
    name: '',
    age: '',
    gender: '',
    last_seen_location: '',
    description: '',
    image: null,
    contact_name: '',
    contact_phone: '',
    contact_phone_2: '',
});

const submit = () => {
    form.post(route('missing-people.store'), {
        forceFormData: true,
    });
};
</script>

<template>
    <AppLayout>
        <div class="py-6 sm:py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold mb-6">{{ trans.report_missing }}</h2>

                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ trans.name }}</label>
                                    <input v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Age -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">{{ trans.age }}</label>
                                        <input v-model="form.age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                        <div v-if="form.errors.age" class="text-red-500 text-sm mt-1">{{ form.errors.age }}</div>
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">{{ trans.gender }}</label>
                                        <select v-model="form.gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div v-if="form.errors.gender" class="text-red-500 text-sm mt-1">{{ form.errors.gender }}</div>
                                    </div>
                                </div>

                                <!-- Last Seen -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ trans.last_seen }}</label>
                                    <textarea v-model="form.last_seen_location" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400"></textarea>
                                    <div v-if="form.errors.last_seen_location" class="text-red-500 text-sm mt-1">{{ form.errors.last_seen_location }}</div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ trans.description }}</label>
                                    <textarea v-model="form.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400"></textarea>
                                </div>

                                <!-- Image Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ trans.upload_photo }}</label>
                                    <input type="file" @input="form.image = $event.target.files[0]" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>
                                </div>

                                <div class="border-t pt-4 mt-2">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ trans.contact }}</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">{{ trans.contact_name }}</label>
                                            <input v-model="form.contact_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                            <div v-if="form.errors.contact_name" class="text-red-500 text-sm mt-1">{{ form.errors.contact_name }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">{{ trans.contact_phone }}</label>
                                            <input v-model="form.contact_phone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                            <div v-if="form.errors.contact_phone" class="text-red-500 text-sm mt-1">{{ form.errors.contact_phone }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">{{ trans.contact_phone_2 }}</label>
                                            <input v-model="form.contact_phone_2" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 placeholder-gray-500 dark:placeholder-gray-400">
                                            <div v-if="form.errors.contact_phone_2" class="text-red-500 text-sm mt-1">{{ form.errors.contact_phone_2 }}</div>
                                        </div>
                                    </div>
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
