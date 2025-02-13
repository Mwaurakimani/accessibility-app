<template>
    <div class="flex h-screen">
        <aside class="w-64 bg-gray-900 text-white p-5">
            <h2 class="text-xl font-bold mb-4">Dashboard</h2>
            <ul class="space-y-3">
                <li>
                    <a :href="route('dashboard')" class="block p-3 rounded hover:bg-gray-700">🏠 Dashboard</a>
                </li>
                <li>
                    <a :href="route('transactions')" class="block p-3 rounded hover:bg-gray-700">💳 Transactions</a>
                </li>
                <li>
                    <a :href="route('withdraw')" class="block p-3 rounded hover:bg-gray-700">💰 Withdraw</a>
                </li>
                <li>
                    <a :href="route('profile')" class="block p-3 rounded hover:bg-gray-700">👤 Profile</a>
                </li>
                <li v-if="user?.isAdmin">
                    <a :href="route('admin.dashboard')" class="block p-3 rounded bg-blue-500 hover:bg-blue-700">🔑 Admin Panel</a>
                </li>
                <li>
                    <button @click="logout" class="block w-full text-left p-3 rounded bg-red-500 hover:bg-red-700 text-white">
                        🚪 Logout
                    </button>
                </li>
            </ul>

            <!-- Accessibility Controls -->
            <div class="mt-6 p-3 bg-gray-800 rounded-lg">
                <p class="text-sm">🔎 Accessibility</p>
                <button @click="increaseFontSize" class="px-2 py-1 mt-2 bg-gray-700 rounded hover:bg-gray-600 text-white">A+</button>
                <button @click="decreaseFontSize" class="px-2 py-1 ml-2 bg-gray-700 rounded hover:bg-gray-600 text-white">A-</button>
            </div>
        </aside>

        <main :style="{ fontSize: `${fontSize}px` }" class="flex-1 p-6 bg-gray-100">
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
import { useAccessibilityStore } from "@/stores/accessibilityStore";
import { storeToRefs } from "pinia";
import { router } from "@inertiajs/vue3";

const store = useAccessibilityStore();
const { fontSize } = storeToRefs(store);

const increaseFontSize = () => store.increaseFontSize();
const decreaseFontSize = () => store.decreaseFontSize();

defineProps({
    user: Object,
});

const logout = () => {
    router.post(route("logout"));
};
</script>
