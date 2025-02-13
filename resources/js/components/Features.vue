<template>
    <section class="p-10 bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6">Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div v-for="feature in features" :key="feature.title" class="p-6 bg-white rounded-lg shadow-lg text-center">
                <i :class="feature.icon" class="text-4xl text-indigo-500"></i>
                <h3 class="text-lg font-semibold mt-3">{{ feature.title }}</h3>
                <p class="text-gray-600">{{ feature.description }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    {title: "Secure Savings", description: "Guaranteed safety of your pension funds.", icon: "fas fa-lock"},
    {title: "Fast Withdrawals", description: "Easy access to your pension anytime.", icon: "fas fa-money-bill-wave"},
    {title: "Community Support", description: "We help you at every step.", icon: "fas fa-hands-helping"}
];
</script>
