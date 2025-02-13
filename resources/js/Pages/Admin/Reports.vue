<template>
    <AdminLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">Pension Fund Reports</h1>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Month</th>
                    <th class="p-3 text-left">Total Contributions</th>
                    <th class="p-3 text-left">Total Withdrawals</th>
                    <th class="p-3 text-left">Net Balance</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="report in reports" :key="report.month" class="border-b">
                    <td class="p-3">{{ report.month }}</td>
                    <td class="p-3">${{ report.contributions }}</td>
                    <td class="p-3">${{ report.withdrawals }}</td>
                    <td class="p-3 font-semibold" :class="report.netBalance < 0 ? 'text-red-600' : 'text-green-600'">
                        ${{ report.netBalance }}
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

const reports = ref([
    { month: "January", contributions: 50000, withdrawals: 20000, netBalance: 30000 },
    { month: "February", contributions: 45000, withdrawals: 25000, netBalance: 20000 },
    { month: "March", contributions: 60000, withdrawals: 55000, netBalance: 5000 },
]);
</script>
