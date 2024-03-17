<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Pagination.vue";
import InputSearch from "@/Components/Inputs/InputSearch.vue"

const props = defineProps({
    users: Object,
});
</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Список Работников
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-7 px-4 sm:px-6 lg:px-14">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1
                                    class="text-base font-semibold leading-6 text-gray-900"
                                >
                                    Работники
                                </h1>
                                <p class="mt-2 text-sm text-gray-700">
                                    Список всех работников включая их, имена,
                                    почту и роль.
                                </p>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <button
                                    type="button"
                                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                >
                                    Добавить Работника
                                </button>
                            </div>
                        </div>

                        <InputSearch
                            class="mt-4 mx-auto w-9/12 sm:w-1/3"
                            id="search" name="search" placeholder="Найти Работника"
                        />

                        <div class="mt-8 flow-root">
                            <div
                                class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
                            >
                                <div
                                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <thead>
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                                >
                                                    ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                                >
                                                    Имя
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                                >
                                                    Город
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                                >
                                                    Роль
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                                                >
                                                    <span class="sr-only"
                                                        >Править</span
                                                    >
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 bg-white"
                                        >
                                            <tr
                                                v-for="worker in users.data"
                                                :key="worker.id"
                                            >
                                                <td
                                                    class="whitespace-nowrap font-semibold py-5 pl-4 pr-3 text-sm sm:pl-0"
                                                >
                                                    {{ worker.id }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div
                                                            class="h-11 w-11 flex-shrink-0"
                                                        >
                                                            <img
                                                                class="h-11 w-11 rounded-full"
                                                                :src="
                                                                    worker.photo
                                                                "
                                                                alt=""
                                                            />
                                                        </div>
                                                        <div class="ml-4">
                                                            <div
                                                                class="font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    worker.name
                                                                }}
                                                            </div>
                                                            <div
                                                                class="mt-1 text-gray-500"
                                                            >
                                                                {{
                                                                    worker.email
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-5 text-sm text-gray-500"
                                                >
                                                    <div class="text-gray-900 px-3 sm:px-0">
                                                        {{ worker.city }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-5 text-sm text-gray-500 capitalize px-3 sm:px-0"
                                                >
                                                    {{ worker.role }}
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                                                >
                                                    <a
                                                        href="#"
                                                        class="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        Править
                                                        <span class="sr-only">
                                                            {{ worker.name }}
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <Pagination :links="users.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
