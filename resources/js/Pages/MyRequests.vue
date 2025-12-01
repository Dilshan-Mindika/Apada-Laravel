<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { useForm, usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    requests: Array,
    phone: String,
});

const page = usePage();
const trans = computed(() => page.props.translations);

const form = useForm({
    phone: props.phone || '',
});

const search = () => {
    form.get(route('my-requests.search'), {
        preserveState: true,
        replace: true,
    });
};

const verify = (id) => {
    if (confirm(trans.value.mark_received_confirm)) {
        router.post(route('my-requests.verify', id));
    }
};
</script>

<template>
    <AppLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold mb-6">{{ trans.my_requests }}</h2>

                        <!-- Search Form -->
                        <form @submit.prevent="search" class="mb-8">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-grow">
                                    <label for="phone" class="sr-only">{{ trans.enter_phone }}</label>
                                    <input v-model="form.phone" type="text" id="phone" :placeholder="trans.enter_phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <div v-if="form.errors.phone" class="text-red-500 text-sm mt-1">{{ form.errors.phone }}</div>
                                </div>
                                <button type="submit" :disabled="form.processing" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ trans.check_status }}
                                </button>
                            </div>
                        </form>

                        <!-- Requests List -->
                        <div v-if="requests" class="space-y-6">
                            <div v-if="requests.length === 0" class="text-center text-gray-500 py-8">
                                {{ trans.no_my_requests }}
                            </div>

                            <div v-for="req in requests" :key="req.id" class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-lg">{{ req.category }}</span>
                                            <StatusBadge :status="req.status" />
                                        </div>
                                        <p class="text-gray-600 text-sm">{{ req.created_at }}</p>
                                        <p class="text-gray-800 mt-2">{{ req.remarks }}</p>
                                    </div>
                                    
                                    <div class="flex-shrink-0">
                                        <button v-if="req.status === 'completed'" @click="verify(req.id)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            {{ trans.confirm_received }}
                                        </button>
                                        <span v-else-if="req.status === 'verified'" class="text-purple-600 font-medium flex items-center">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ trans.received }}
                                        </span>
                                        <span v-else class="text-gray-500 text-sm italic">
                                            {{ trans.not_received_yet }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
