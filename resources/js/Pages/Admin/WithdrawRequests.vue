<template>
    <AdminLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">Withdrawal Requests</h1>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="request in requests" :key="request.id" class="border-b">
                    <td class="p-3">{{ request.user }}</td>
                    <td class="p-3">${{ request.amount }}</td>
                    <td class="p-3">
                        <span :class="statusClass(request.status)">{{ request.status }}</span>
                    </td>
                    <td class="p-3">
                        <button @click="approveRequest(request.id)" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            Approve
                        </button>
                        <button @click="rejectRequest(request.id)" class="ml-2 px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Reject
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const requests = ref([
    { id: 1, user: "John Doe", amount: 500, status: "Pending" },
    { id: 2, user: "Alice Smith", amount: 1000, status: "Approved" },
    { id: 3, user: "Mark Johnson", amount: 750, status: "Pending" },
]);

const statusClass = (status) => {
    return status === "Approved" ? "text-green-600 font-semibold" : "text-yellow-600 font-semibold";
};

const approveRequest = (id) => {
    requests.value = requests.value.map(req => req.id === id ? { ...req, status: "Approved" } : req);
};

const rejectRequest = (id) => {
    requests.value = requests.value.map(req => req.id === id ? { ...req, status: "Rejected" } : req);
};
</script>
