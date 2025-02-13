<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Help & Support</h1>
            <p class="text-gray-600">Submit a support request.</p>

            <div class="mt-4">
                <label class="block text-gray-600">Subject</label>
                <input v-model="ticket.subject" type="text" class="w-full p-3 border rounded-lg" />

                <label class="block text-gray-600 mt-4">Message</label>
                <textarea v-model="ticket.message" class="w-full p-3 border rounded-lg"></textarea>

                <button @click="submitTicket" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Submit Ticket
                </button>

                <div v-if="message" class="mt-4 p-3 bg-green-500 text-white rounded-lg">
                    {{ message }}
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>

<script setup>
import { ref } from "vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const ticket = ref({ subject: "", message: "" });
const message = ref("");

const submitTicket = () => {
    if (!ticket.value.subject || !ticket.value.message) {
        message.value = "Please fill in all fields.";
        return;
    }
    message.value = "Support ticket submitted!";
    ticket.value.subject = "";
    ticket.value.message = "";
};
</script>
