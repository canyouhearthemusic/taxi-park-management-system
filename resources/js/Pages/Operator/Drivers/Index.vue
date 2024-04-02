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
    drivers: Object,
    search: String,
    sort: String,
});

const form = useForm({
    search: props.search,
    sort: props.sort,
});

const TABLE_HEADERS = ["ID", "Имя", "ИИН", "Город Нахождения"];

watch(() => form.data(), debounce(submitForm, 500));

function submitForm() {
    form.get(route("operator.drivers.index"), {
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
                Список Водителей
            </h2>
        </template>

        <div class="py-7 px-4 sm:px-6 lg:px-14">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">
                        Водители
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Список всех водителей закреплённые за Вами.
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <Link
                        :href="route('operator.drivers.create')"
                        class="w-1/2 sm:w-full"
                    >
                        <SecondaryButton class="w-full py-3 sm:py-2">
                            Добавить Водителя
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
                        placeholder="Найти Водителя"
                        v-model="form.search"
                    />

                    <div
                        class="mt-8 w-3/4 mx-auto sm:absolute sm:-top-2 sm:right-0 sm:mt-0 sm:w-1/6 sm:ml-auto"
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
                    <TableOutline v-if="drivers.data.length">
                        <template #header>
                            <TableHeader :headers="TABLE_HEADERS" />
                        </template>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="driver in drivers.data" :key="driver.id">
                                <td
                                    class="whitespace-nowrap font-semibold py-5 pl-4 pr-3 text-sm sm:pl-0"
                                >
                                    {{ driver.id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0"
                                >
                                    <div class="flex items-center">
                                        <!-- <div class="h-11 w-11 flex-shrink-0 mr-4">
                                            <img
                                                class="h-11 w-11 rounded-full"
                                                :src="driver.photo"
                                                alt=""
                                            />
                                        </div> -->
                                        <div>
                                            <div
                                                class="font-medium text-gray-900"
                                            >
                                                {{ driver.name }}
                                            </div>
                                            <!-- <div class="mt-1 text-gray-500">
                                                {{ driver.email }}
                                            </div> -->
                                        </div>
                                    </div>
                                </td>

                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-500"
                                >
                                    <div class="text-gray-900 px-3 sm:px-0">
                                        {{ driver.IIN }}
                                    </div>
                                </td>

                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-500"
                                >
                                    <div class="text-gray-900 px-3 sm:px-0">
                                        {{ driver.city_name }}
                                    </div>
                                </td>

                                <!-- <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-500"
                                >
                                    <div class="text-gray-900 px-3 sm:px-0">
                                        {{ driver.city.name }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap py-5 text-sm text-gray-500 capitalize px-3 sm:px-0"
                                >
                                    {{ driver.role.key }}
                                </td> -->
                                <td
                                    class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                                >
                                    <Link
                                        :href="
                                            route('operator.drivers.edit', {
                                                driver: driver.id,
                                            })
                                        "
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Править
                                        <span class="sr-only">
                                            {{ driver.name }}
                                        </span>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </TableOutline>

                    <div
                        v-else
                        class="text-center text-2xl mt-3 mb-10 font-semibold text-gray-600"
                    >
                        Нет Водителей.
                    </div>
                </div>
            </div>
            <Pagination class="mt-4" :links="drivers.links" />
        </div>
    </AppLayout>
</template>
