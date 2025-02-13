<template>
    <AdminLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">User Management</h1>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id" class="border-b">
                    <td class="p-3">{{ user.name }}</td>
                    <td class="p-3">{{ user.email }}</td>
                    <td class="p-3">
                        <span :class="roleClass(user.role)">{{ user.role }}</span>
                    </td>
                    <td class="p-3">
                        <button @click="deleteUser(user.id)" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Delete
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

const users = ref([
    { id: 1, name: "John Doe", email: "john@example.com", role: "User" },
    { id: 2, name: "Alice Smith", email: "alice@example.com", role: "Admin" },
    { id: 3, name: "Mark Johnson", email: "mark@example.com", role: "User" },
]);

const roleClass = (role) => {
    return role === "Admin" ? "text-blue-600 font-semibold" : "text-gray-600 font-semibold";
};

const deleteUser = (id) => {
    users.value = users.value.filter(user => user.id !== id);
};
</script>
