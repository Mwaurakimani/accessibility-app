<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>

            <!-- Display Error Messages -->
            <div v-if="errors" class="mb-4 text-red-600 text-sm">
                <p v-for="(error, index) in errors" :key="index">{{ error }}</p>
            </div>

            <form @submit.prevent="register" class="mt-4">
                <div>
                    <label class="block text-gray-600">Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400"
                        required
                    />
                </div>
                <div class="mt-3">
                    <label class="block text-gray-600">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400"
                        required
                    />
                </div>
                <div class="mt-3">
                    <label class="block text-gray-600">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400"
                        required
                    />
                </div>
                <div class="mt-3">
                    <label class="block text-gray-600">Confirm Password</label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400"
                        required
                    />
                </div>
                <button type="submit" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Sign Up
                </button>
            </form>

            <div class="mt-4 text-center">
                <p>Already have an account?
                    <a href="/login" class="text-indigo-600 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3"; // Import Inertia.js router

const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "" // Required for Fortify
});

const errors = ref(null);

const register = () => {
    router.post("/register", form.value, {
        onError: (response) => {
            errors.value = response;
        }
    });
};
</script>
