<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Welcome, {{ user.name }}</h1>
            <p class="text-gray-600">Your pension summary is below:</p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Balance -->
                <div class="p-4 bg-indigo-500 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Total Balance</h3>
                    <p class="text-2xl font-bold">Ksh{{ formattedBalance }}</p>
                </div>

                <!-- Last Transaction -->
                <div class="p-4 bg-green-500 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Last Transaction</h3>
                    <p class="text-2xl font-bold">Ksh{{ formattedLastTransaction }}</p>
                </div>

                <!-- Next Payout -->
                <div class="p-4 bg-yellow-500 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Next Payout</h3>
                    <p class="text-2xl font-bold">Ksh{{ formattedNextPayout }}</p>
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>

<script setup>
import { computed } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// Define props with default values
const props = defineProps({
    user: { type: Object, required: true },
    balance: { type: Number, default: 0 },
    lastTransaction: { type: Number, default: 0 },
    nextPayout: { type: Number, default: 0 }
});

// Use computed properties to format numbers
const formattedBalance = computed(() => props.balance?.toLocaleString() ?? "0");
const formattedLastTransaction = computed(() => props.lastTransaction?.toLocaleString() ?? "0");
const formattedNextPayout = computed(() => props.nextPayout?.toLocaleString() ?? "0");
</script>
