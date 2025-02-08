<template>
    <div class="flex h-screen">
        <aside class="w-64 bg-gray-900 text-white p-5">
            <h2 class="text-xl font-bold">Admin Panel</h2>
            <ul class="mt-4 space-y-2">
                <li><a href="/admin/dashboard" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a></li>
                <li><a href="/admin/reports" class="block py-2 px-4 rounded hover:bg-gray-700">Reports</a></li>
            </ul>
        </aside>
        <main class="flex-1 p-6 bg-gray-100">
            <slot></slot>
        </main>
    </div>
</template>
