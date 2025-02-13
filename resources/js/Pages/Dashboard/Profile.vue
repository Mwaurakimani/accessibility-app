<template>
    <DashboardLayout>
        <section class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold">Profile</h1>
            <p class="text-gray-600">Manage your personal details.</p>

            <form @submit.prevent="updateProfile" class="mt-6">
                <div>
                    <label class="block text-gray-600">Name</label>
                    <input v-model="form.name" type="text" class="w-full p-3 border rounded-lg" required />
                </div>

                <div class="mt-4">
                    <label class="block text-gray-600">Email</label>
                    <input v-model="form.email" type="email" class="w-full p-3 border rounded-lg" required />
                </div>

                <button type="submit" class="mt-4 w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">
                    Save Changes
                </button>

                <div v-if="message" class="mt-4 p-3 bg-green-500 text-white rounded-lg">
                    {{ message }}
                </div>
            </form>
        </section>
    </DashboardLayout>
</template>

<script setup>
import {ref} from "vue";
import {useForm, router} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

const props = defineProps({
    user: Object,
    message: String
});

// Form data for updating profile
const form = useForm({
    name: props.user.name,
    email: props.user.email
});

// Success message state
const message = ref(props.message || "");

// Update profile function
const updateProfile = () => {
    form.post(route("profile"), {
        onSuccess: () => {
            message.value = "Profile updated successfully!";
        }
    });
};
</script>
