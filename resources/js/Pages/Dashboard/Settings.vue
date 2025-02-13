<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Settings</h1>
            <p class="text-gray-600">Manage your preferences.</p>

            <div class="mt-4">
                <label class="block text-gray-600">Notification Preferences</label>
                <select v-model="notificationPreference" class="w-full p-3 border rounded-lg">
                    <option value="all">All Notifications</option>
                    <option value="email">Email Only</option>
                    <option value="none">No Notifications</option>
                </select>

                <button @click="saveSettings" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Save Settings
                </button>

                <div v-if="message" class="mt-4 p-3 bg-green-500 text-white rounded-lg">
                    {{ message }}
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>

<script setup>
import { ref } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const notificationPreference = ref("all");
const message = ref("");

const saveSettings = () => {
    message.value = "Settings updated successfully!";
};
</script>
