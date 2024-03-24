<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Pagination.vue";
import InputSearch from "@/Components/Inputs/InputSearch.vue";
import TableOutline from "@/Components/Tables/TableOutline.vue";
import TableHeader from "@/Components/Tables/TableHeader.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { debounce } from "lodash";
import { watch } from "vue";

const props = defineProps({
    users: Object,
    search: String,
    sort: String,
});

const form = useForm({
    search: props.search,
    sort: props.sort,
});

const TABLE_HEADERS = ["ID", "Имя", "Город", "Роль"];

watch(() => form.data(), debounce(submitForm, 500));

function submitForm() {
    form.get(route("admin.workers.index"), {
        data: {
            search: form.search,
            sort: form.sort,
        },
        replace: true,
        preserveState: true,
        preserveScroll: true,
    });
}
</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Список Работников
            </h2>
        </template>

        <div class="py-7 px-4 sm:px-6 lg:px-14">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">
                        Работники
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Список всех работников включая их, имена, почту и роль.
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <Link :href="route('admin.workers.create')" class="w-full">
                        <SecondaryButton> Добавить Работника </SecondaryButton>
                    </Link>
                </div>
            </div>

            <div class="mt-6 mx-auto sm:relative">
                <form @submit.prevent="submitForm">
                    <InputSearch
                        class="w-9/12 sm:w-1/3"
                        id="search"
                        name="search"
                        placeholder="Найти Работника"
                        v-model="form.search"
                    />

                    <div
                        class="mt-4 w-3/4 mx-auto sm:absolute sm:-top-2 sm:right-0 sm:mt-0 sm:w-1/6 sm:ml-auto"
                    >
                        <label
                            for="sort"
                            class="block text-sm font-medium text-gray-900"
                        >
                            Сортировать По:
                        </label>

                        <select
                            id="sort"
                            name="sort"
                            class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            v-model="form.sort"
                        >
                            <option selected disabled :value="''">
                                Выбрать
                            </option>
                            <option value="name_asc">Имени (А-Я)</option>
                            <option value="name_desc">Имени (Я-А)</option>
                            <option value="city_asc">Городу (А-Я)</option>
                            <option value="city_desc">Городу (Я-А)</option>
                            <option value="role_asc">Роли (А-Я)</option>
                            <option value="role_desc">Роли (Я-А)</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <TableOutline>
                        <template #header>
                            <TableHeader :headers="TABLE_HEADERS" />
                        </template>

                        <tbody
                            v-if="users.data.length"
                            class="divide-y divide-gray-200 bg-white"
                        >
                            <tr v-for="worker in users.data" :key="worker.id">
                                <td
                                    class="whitespace-nowrap font-semibold py-5 pl-4 pr-3 text-sm sm:pl-0"
                                >
                                    {{ worker.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0"
                                >
                                    <div class="flex items-center">
                                        <div class="h-11 w-11 flex-shrink-0">
                                            <img
                                                class="h-11 w-11 rounded-full"
                                                :src="worker.photo"
                                                alt=""
                                            />
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="font-medium text-gray-900"
                                            >
                                                {{ worker.name }}
                                            </div>
                                            <div class="mt-1 text-gray-500">
                                                {{ worker.email }}
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
                                    <Link
                                        href="#"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Править
                                        <span class="sr-only">
                                            {{ worker.name }}
                                        </span>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </TableOutline>
                </div>
            </div>
            <Pagination :links="users.links" />
        </div>
    </AppLayout>
</template>
