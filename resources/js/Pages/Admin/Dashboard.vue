<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    stats: Object,
    requests: Object,
});

const deleteRequest = (id) => {
    if (confirm('Are you sure you want to delete this request?')) {
        router.delete(route('admin.destroy', id));
    }
};
</script>

<template>
    <AppLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium uppercase">Total Requests</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ stats.total }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium uppercase">Pending</div>
                        <div class="mt-2 text-3xl font-bold text-yellow-600">{{ stats.pending }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium uppercase">Accepted</div>
                        <div class="mt-2 text-3xl font-bold text-blue-600">{{ stats.accepted }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-500 text-sm font-medium uppercase">Completed</div>
                        <div class="mt-2 text-3xl font-bold text-green-600">{{ stats.completed }}</div>
                    </div>
                </div>

                <!-- Requests Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-bold mb-4">Manage Requests</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="req in requests.data" :key="req.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ req.id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ req.name }}</div>
                                            <div class="text-sm text-gray-500">{{ req.phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ req.category }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <StatusBadge :status="req.status" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button @click="deleteRequest(req.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-4" v-if="requests.links.length > 3">
                            <div class="flex justify-center">
                                <template v-for="(link, key) in requests.links" :key="key">
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
