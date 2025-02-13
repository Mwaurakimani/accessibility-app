<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Welcome, {{ user.name }}</h1>
            <p class="text-gray-600">Your pension summary is below:</p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-indigo-500 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Total Balance</h3>
                    <p class="text-2xl font-bold">${{ balance }}</p>
                </div>
                <div class="p-4 bg-green-500 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Last Transaction</h3>
                    <p class="text-2xl font-bold">${{ lastTransaction }}</p>
                </div>
                <div class="p-4 bg-yellow-500 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Next Payout</h3>
                    <p class="text-2xl font-bold">${{ nextPayout }}</p>
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const user = { name: "John Doe" };
const balance = 25000;
const lastTransaction = 1000;
const nextPayout = 1200;
</script>
