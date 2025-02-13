<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Withdrawal Requests</h1>
            <p class="text-gray-600">Request a withdrawal or manage pending requests.</p>

            <!-- Withdrawal Form -->
            <div class="mt-6 p-6 bg-gray-100 border rounded-lg">
                <h2 class="text-lg font-bold mb-3">
                    {{ form.id ? "Update Withdrawal Request" : user.isAdmin ? "Approve Withdrawal Request" : "Request a Withdrawal" }}
                </h2>
                <form @submit.prevent="submitWithdrawal">
                    <input v-model="form.id" type="hidden" />

                    <label class="block text-gray-600 flex items-center">
                        Amount
                        <button @click="speak('Enter the amount for withdrawal')" type="button" class="ml-2 text-gray-500">
                            🔊
                        </button>
                    </label>
                    <input v-model="form.amount" type="number" class="w-full p-3 border rounded-lg" required />

                    <label v-if="user.isAdmin" class="block text-gray-600 mt-4 flex items-center">
                        Status
                        <button @click="speak('Choose withdrawal status: pending, approved, or rejected')" type="button" class="ml-2 text-gray-500">
                            🔊
                        </button>
                    </label>
                    <select v-if="user.isAdmin" v-model="form.status" class="w-full p-3 border rounded-lg">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>

                    <button type="submit" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                        {{ form.id ? "Update Withdrawal" : "Submit Request" }}
                    </button>
                </form>
            </div>

            <!-- Withdrawal Table -->
            <table class="w-full mt-6 border-collapse border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border">Date</th>
                    <th class="p-3 border">User</th>
                    <th class="p-3 border">Amount</th>
                    <th class="p-3 border">Status</th>
                    <th v-if="user.isAdmin" class="p-3 border">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="withdrawal in withdrawals.data" :key="withdrawal.id" class="text-center">
                    <td class="p-3 border">{{ formatDate(withdrawal.created_at) }}</td>
                    <td class="p-3 border">{{ withdrawal.user?.name ?? 'N/A' }}</td>
                    <td class="p-3 border">${{ withdrawal.amount.toLocaleString() }}</td>
                    <td class="p-3 border">
              <span class="px-2 py-1 rounded-lg text-white" :class="{
                'bg-green-500': withdrawal.status === 'approved',
                'bg-yellow-500': withdrawal.status === 'pending',
                'bg-red-500': withdrawal.status === 'rejected'
              }">
                {{ withdrawal.status }}
              </span>
                    </td>
                    <td v-if="user.isAdmin" class="p-3 border">
                        <button
                            @click="editWithdrawal(withdrawal)"
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
import { useForm } from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const props = defineProps({
    withdrawals: Object,
    user: Object,
});

const form = useForm({
    id: "",
    amount: "",
    status: "pending",
});

const submitWithdrawal = () => {
    if (form.id) {
        form.post(route("withdraw", { id: form.id }));
    } else {
        form.post(route("withdraw"));
    }
    form.reset();
};

const editWithdrawal = (withdrawal) => {
    form.id = withdrawal.id;
    form.amount = withdrawal.amount;
    form.status = withdrawal.status;
};

const speak = (text) => {
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = "en-US";
    speechSynthesis.speak(utterance);
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
};
</script>
