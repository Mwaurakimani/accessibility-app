<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-700">Forgot Password?</h2>
            <form @submit.prevent="sendResetLink" class="mt-4">
                <div>
                    <label class="block text-gray-600">Email</label>
                    <input v-model="form.email" type="email" class="w-full p-3 border rounded-lg" required />
                </div>
                <button type="submit" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Send Reset Link
                </button>
            </form>
            <div class="mt-4 text-center">
                <router-link to="/login" class="text-indigo-600 hover:underline">Back to Login</router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const form = ref({ email: "" });

const sendResetLink = () => {
    console.log("Sending reset link to:", form.value.email);
};
</script>
