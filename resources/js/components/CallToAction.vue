<template>
    <section class="text-center p-10 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <h2 class="text-3xl font-bold">Join Us Today!</h2>
        <p class="mt-2">Secure your retirement with a modern pension system.</p>
        <button @click="register" class="mt-4 px-6 py-2 bg-white text-indigo-600 font-semibold rounded-lg shadow hover:bg-gray-100">
            Get Started
        </button>
    </section>
</template>

<script setup>
const register = () => {
    window.location.href = "/register";
};
</script>
