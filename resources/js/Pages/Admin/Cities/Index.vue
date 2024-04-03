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
    cities: Object,
    search: String,
});

const form = useForm({
    search: props.search,
});

const TABLE_HEADERS = [
    "ID",
    "Регион",
    "Город",
    "Кол-во сотрудников",
    "Кол-во водителей",
];

watch(() => form.data(), debounce(submitForm, 500));

function submitForm() {
    form.get(route("admin.cities.index"), {
        data: {
            search: form.search,
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
                        :href="route('admin.cities.create')"
                        class="w-1/2 sm:w-full"
                    >
                        <SecondaryButton class="w-full py-3 sm:py-2">
                            Добавить Город
                        </SecondaryButton>
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
                    <TableOutline v-if="cities.data.length">
                        <template #header>
                            <TableHeader :headers="TABLE_HEADERS" />
                        </template>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="city in cities.data" :key="city.id">
                                <td
                                    class="whitespace-nowrap font-semibold py-5 pl-4 pr-3 text-sm sm:pl-0"
                                >
                                    {{ city.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-500"
                                >
                                    <div class="text-gray-600 px-0">
                                        {{ city.region }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-900 capitalize px-0"
                                >
                                    {{ city.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-900 capitalize px-0 sm:pl-12"
                                >
                                    {{ city.workers_count }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-900 capitalize px-0 sm:pl-12"
                                >
                                    {{ city.drivers_count }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                                >
                                    <Link
                                        :href="
                                            route('admin.cities.edit', {
                                                city: city.id,
                                            })
                                        "
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Править
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </TableOutline>

                    <div
                        v-else
                        class="text-center text-2xl mt-3 mb-10 font-semibold text-gray-600"
                    >
                        Нет городов.
                    </div>
                </div>
            </div>
            <Pagination class="mt-4" :links="cities.links" />
        </div>
    </AppLayout>
</template>
