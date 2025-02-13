<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-700">Reset Password</h2>
            <form @submit.prevent="resetPassword" class="mt-4">
                <div>
                    <label class="block text-gray-600">New Password</label>
                    <input v-model="form.password" type="password" class="w-full p-3 border rounded-lg" required />
                </div>
                <button type="submit" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const form = ref({ password: "" });

const resetPassword = () => {
    console.log("Resetting password...");
};
</script>
