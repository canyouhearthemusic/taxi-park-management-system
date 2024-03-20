<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Pagination.vue";
import InputSearch from "@/Components/Inputs/InputSearch.vue";
import TableOutline from "@/Components/Tables/TableOutline.vue";
import TableHeader from "@/Components/Tables/TableHeader.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { debounce } from "lodash";
import { watch } from "vue";

const props = defineProps({
    cities: Object,
    search: String,
});

const form = useForm({
    search: props.search,
});

const TABLE_HEADERS = ["ID", "Регион", "Город"];

watch(() => form.data(), debounce(submitForm, 500));

function submitForm() {
    form.get(route("admin.cities.index"), {
        data: {
            search: form.search
        },
        replace: true,
        preserveState: true,
        preserveScroll: true,
    });
}
</script>

<template>
    <AppLayout title="Список Городов">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Список Городов
            </h2>
        </template>

        <div class="py-7 px-4 sm:px-6 lg:px-14">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">
                        Города
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Список всех городов.
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <Link
                        class="w-full block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Добавить Город
                    </Link>
                </div>
            </div>

            <div class="mt-6 mx-auto sm:relative">
                <form @submit.prevent="submitForm">
                    <InputSearch
                        class="w-9/12 sm:w-1/3"
                        id="search"
                        name="search"
                        placeholder="Найти Город"
                        v-model="form.search"
                    />
                </form>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <TableOutline>
                        <template #header>
                            <TableHeader :headers="TABLE_HEADERS" />
                        </template>

                        <tbody v-if="cities.data.length" class="divide-y divide-gray-200 bg-white">
                            <tr v-for="city in cities.data" :key="city.id">
                                <td
                                    class="whitespace-nowrap font-semibold py-5 pl-4 pr-3 text-sm sm:pl-0"
                                >
                                    {{ city.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-500"
                                >
                                    <div class="text-gray-600 px-3 sm:px-0">
                                        {{ city.region }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-900 capitalize px-3 sm:px-0"
                                >
                                    {{ city.name }}
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
                                            {{ city.name }}
                                        </span>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </TableOutline>
                </div>
            </div>
            <Pagination :links="cities.links" />
        </div>
    </AppLayout>
</template>