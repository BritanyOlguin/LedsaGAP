<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row justify-between">
                <div class="flex-grow mb-4 sm:mb-0">
                    Usuarios
                    <input v-model="searchQuery" type="text" placeholder="Buscar usuarios..."
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                </div>
                <button @click="createUser"
                    class="flex items-center justify-center rounded-md bg-[#f07c34] px-2 py-1 text-sm text-white hover:bg-[#d66a2c] focus:outline-none focus:ring-2 focus:ring-[#f07c34] focus:ring-opacity-50 sm:ml-4 sm:mt-2">
                    <i class="pi pi-plus mr-2"></i> Crear nuevo usuario
                </button>
            </div>
        </template>

        <!-- Modal para crear nuevo usuario -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-5 rounded w-full max-w-md">
                <h2 class="text-lg mb-4">Crear Nuevo Usuario</h2>
                <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input v-model="form.name" type="text" id="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo:</label>
                        <input v-model="form.email" type="email" id="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña:</label>
                        <input v-model="form.password" type="password" id="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                            contraseña:</label>
                        <input v-model="form.password_confirmation" type="password" id="password_confirmation" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showModal = false"
                            class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Cerrar</button>
                        <button type="submit"
                            class="bg-orange-600 text-white py-2 px-4 rounded hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-opacity-50">Registrar
                            Usuario</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alertas de info -->
        <!-- <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-12 items-center justify-center bg-orange-600">
                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>
            </div>

            <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                    <span class="font-semibold text-orange-600">Info</span>
                    <p class="text-sm text-gray-600">Sample table page</p>
                </div>
            </div>
        </div> -->

        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Correo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="filteredUsers.length === 0" class="text-gray-700">
                        <td colspan="2" class="border-b border-gray-200 bg-white px-7 py-7 text-sm text-center">
                            <p class="text-gray-900 whitespace-no-wrap" style="font-size: 17px;">No se encontraron
                                coincidencias
                            </p>
                        </td>
                    </tr>
                    <tr v-else v-for="user in filteredUsers" :key="user.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="users.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';


const props = defineProps({
    users: Object
})

const searchQuery = ref('');

const filteredUsers = computed(() => {
    if (!searchQuery.value) {
        return props.users.data;
    }
    return props.users.data.filter(user =>
        user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const showModal = ref(false);
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const createUser = () => showModal.value = true;
const handleSubmit = () => {
    form.post('/users/create', {
        onSuccess: () => showModal.value = false,
    });
};
</script>
