<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">Pension Calculator</h1>
            <p class="text-gray-600">Estimate your future pension based on your savings.</p>

            <div class="mt-4">
                <label class="block text-gray-600">Monthly Contribution</label>
                <input v-model="monthlyContribution" type="number" class="w-full p-3 border rounded-lg" />

                <label class="block text-gray-600 mt-4">Years Until Retirement</label>
                <input v-model="years" type="number" class="w-full p-3 border rounded-lg" />

                <button @click="calculate" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Calculate
                </button>

                <p v-if="estimatedPension !== null" class="mt-4 text-green-600 font-semibold">
                    Estimated Pension: ${{ estimatedPension }}
                </p>
            </div>
        </section>
    </DashboardLayout>
</template>

<script setup>
import { ref } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";


const monthlyContribution = ref(500);
const years = ref(20);
const estimatedPension = ref(null);

const calculate = () => {
    estimatedPension.value = monthlyContribution.value * years.value * 12;
};
</script>
