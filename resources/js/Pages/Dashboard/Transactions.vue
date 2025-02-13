<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Transaction History</h1>
            <p class="text-gray-600">View and manage pension transactions.</p>

            <!-- Transaction Form (Users Request, Admins Approve/Reject) -->
            <div class="mt-6 p-6 bg-gray-100 border rounded-lg">
                <h2 class="text-lg font-bold mb-3">
                    {{ form.id ? "Update Transaction" : user.isAdmin ? "Approve Transaction Request" : "Request a Transaction" }}
                </h2>
                <form @submit.prevent="submitTransaction">
                    <input v-model="form.id" type="hidden" />

                    <label class="block text-gray-600">Amount</label>
                    <input v-model="form.amount" type="number" class="w-full p-3 border rounded-lg" required />

                    <label class="block text-gray-600 mt-4">Transaction Type</label>
                    <select v-model="form.transaction_type" class="w-full p-3 border rounded-lg">
                        <option value="deposit">Deposit</option>
                        <option value="pension">Pension</option>
                    </select>

                    <label v-if="user.isAdmin" class="block text-gray-600 mt-4">Status</label>
                    <select v-if="user.isAdmin" v-model="form.status" class="w-full p-3 border rounded-lg">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>

                    <button type="submit" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                        {{ form.id ? "Update Transaction" : "Submit Request" }}
                    </button>
                </form>
            </div>

            <!-- Transaction Table -->
            <table class="w-full mt-6 border-collapse border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border">Date</th>
                    <th class="p-3 border">User</th>
                    <th class="p-3 border">Type</th>
                    <th class="p-3 border">Amount</th>
                    <th class="p-3 border">Status</th>
                    <th v-if="user.isAdmin" class="p-3 border">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="transaction in transactions.data" :key="transaction.id" class="text-center">
                    <td class="p-3 border">{{ formatDate(transaction.created_at) }}</td>
                    <td class="p-3 border">{{ transaction.user?.name ?? 'N/A' }}</td>
                    <td class="p-3 border">{{ transaction.transaction_type }}</td>
                    <td class="p-3 border">Ksh{{ transaction.amount.toLocaleString() }}</td>
                    <td class="p-3 border">
              <span class="px-2 py-1 rounded-lg text-white" :class="{
                'bg-green-500': transaction.status === 'completed',
                'bg-yellow-500': transaction.status === 'pending',
                'bg-red-500': transaction.status === 'rejected'
              }">
                {{ transaction.status }}
              </span>
                    </td>
                    <td v-if="user.isAdmin" class="p-3 border">
                        <button
                            @click="editTransaction(transaction)"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-700"
                        >
                            Edit
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </DashboardLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const props = defineProps({
    transactions: Object,
    user: Object,
});

const form = useForm({
    id: "",
    amount: "",
    transaction_type: "deposit",
    status: "pending",
});

const submitTransaction = () => {
    if (form.id) {
        form.post(route("transactions", { id: form.id }));
    } else {
        form.post(route("transactions"));
    }
    form.reset();
};

const editTransaction = (transaction) => {
    form.id = transaction.id;
    form.amount = transaction.amount;
    form.transaction_type = transaction.transaction_type;
    form.status = transaction.status;
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
};
</script>
