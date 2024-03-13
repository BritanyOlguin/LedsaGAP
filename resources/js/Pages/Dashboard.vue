<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Archivos del personal
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <button v-if="$page.props.user.permissions.includes('leer archivos')">
                    Nueva carpeta
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
</script>

<style scoped>
button {
    background-color: green;
    color: white;
    padding: 20px;
    margin: 5px;
}
</style>