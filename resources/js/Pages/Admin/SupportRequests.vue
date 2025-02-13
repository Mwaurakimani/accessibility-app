<template>
    <AdminLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">User Support Requests</h1>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Issue</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="ticket in tickets" :key="ticket.id" class="border-b">
                    <td class="p-3">{{ ticket.user }}</td>
                    <td class="p-3">{{ ticket.issue }}</td>
                    <td class="p-3 text-yellow-600 font-semibold">{{ ticket.status }}</td>
                </tr>
                </tbody>
            </table>
        </section>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const tickets = ref([
    { id: 1, user: "John Doe", issue: "Withdrawal Delay", status: "Pending" },
    { id: 2, user: "Alice Smith", issue: "Account Access Issue", status: "In Progress" },
]);
</script>
