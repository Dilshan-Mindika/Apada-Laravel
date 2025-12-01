<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatusBadge from '@/Components/StatusBadge.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    stats: Object,
    requests: Object,
    missingPeople: Object,
});

const activeTab = ref('requests');
const editingRequest = ref(null);
const editingPerson = ref(null);

const requestForm = useForm({
    status: '',
    category: '',
});

const personForm = useForm({
    status: '',
    name: '',
});

// --- Requests Logic ---
const editRequest = (req) => {
    editingRequest.value = req;
    requestForm.status = req.status;
    requestForm.category = req.category;
};

const updateRequest = () => {
    requestForm.put(route('admin.requests.update', editingRequest.value.id), {
        onSuccess: () => editingRequest.value = null,
    });
};

const deleteRequest = (id) => {
    if (confirm('Are you sure you want to delete this request?')) {
        router.delete(route('admin.requests.destroy', id));
    }
};

// --- Missing People Logic ---
const editPerson = (person) => {
    editingPerson.value = person;
    personForm.status = person.status;
    personForm.name = person.name;
};

const updatePerson = () => {
    personForm.put(route('admin.missing.update', editingPerson.value.id), {
        onSuccess: () => editingPerson.value = null,
    });
};

const deletePerson = (id) => {
    if (confirm('Are you sure you want to delete this missing person record?')) {
        router.delete(route('admin.missing.destroy', id));
    }
};
</script>

<template>
    <AppLayout>
        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Tabs -->
                <div class="mb-6 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button @click="activeTab = 'requests'" :class="[activeTab === 'requests' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']">
                            Relief Requests
                        </button>
                        <button @click="activeTab = 'missing'" :class="[activeTab === 'missing' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']">
                            Missing People
                        </button>
                    </nav>
                </div>

                <!-- Requests Tab -->
                <div v-if="activeTab === 'requests'">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Total Requests</div>
                            <div class="mt-2 text-3xl font-bold text-gray-900">{{ stats.requests.total }}</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Pending</div>
                            <div class="mt-2 text-3xl font-bold text-yellow-600">{{ stats.requests.pending }}</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Accepted</div>
                            <div class="mt-2 text-3xl font-bold text-blue-600">{{ stats.requests.accepted }}</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Completed</div>
                            <div class="mt-2 text-3xl font-bold text-green-600">{{ stats.requests.completed }}</div>
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <button @click="editRequest(req)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
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

                <!-- Missing People Tab -->
                <div v-if="activeTab === 'missing'">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Total Reported</div>
                            <div class="mt-2 text-3xl font-bold text-gray-900">{{ stats.missing_people.total }}</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Missing</div>
                            <div class="mt-2 text-3xl font-bold text-red-600">{{ stats.missing_people.missing }}</div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="text-gray-500 text-sm font-medium uppercase">Found</div>
                            <div class="mt-2 text-3xl font-bold text-green-600">{{ stats.missing_people.found }}</div>
                        </div>
                    </div>

                    <!-- Missing People Table -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-xl font-bold mb-4">Manage Missing People</h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="person in missingPeople.data" :key="person.id">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ person.id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ person.name }}</div>
                                                <div class="text-sm text-gray-500">{{ person.age }} years</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ person.contact_name }}<br>
                                                {{ person.contact_phone }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span :class="person.status === 'found' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                                    {{ person.status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <button @click="editPerson(person)" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                                <button @click="deletePerson(person.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4" v-if="missingPeople.links.length > 3">
                                <div class="flex justify-center">
                                    <template v-for="(link, key) in missingPeople.links" :key="key">
                                        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                                        <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-blue-500 focus:text-blue-500" :class="{ 'bg-blue-600 text-white': link.active }" :href="link.url" v-html="link.label" />
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Request Modal -->
                <div v-if="editingRequest" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="editingRequest = null"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Request</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Category</label>
                                        <select v-model="requestForm.category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="Food">Food</option>
                                            <option value="Water">Water</option>
                                            <option value="Medicine">Medicine</option>
                                            <option value="Clothes">Clothes</option>
                                            <option value="Transport">Transport</option>
                                            <option value="Sanitary">Sanitary Items</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <select v-model="requestForm.status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="pending">Pending</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="delivering">Delivering</option>
                                            <option value="completed">Completed</option>
                                            <option value="verified">Verified</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" @click="updateRequest" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Save
                                </button>
                                <button type="button" @click="editingRequest = null" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Missing Person Modal -->
                <div v-if="editingPerson" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="editingPerson = null"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Missing Person</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <input v-model="personForm.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <select v-model="personForm.status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="missing">Missing</option>
                                            <option value="found">Found</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" @click="updatePerson" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Save
                                </button>
                                <button type="button" @click="editingPerson = null" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
