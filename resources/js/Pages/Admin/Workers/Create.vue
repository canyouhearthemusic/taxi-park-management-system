<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    roles: Array,
    cities: Array,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    city: "",
    role: "",
});

function submitForm() {
    form.post(route("admin.workers.store"));
}
</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Создать Работника
            </h2>
        </template>

        <div class="py-7 px-4 sm:px-6 lg:px-14">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Создать Работника
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-700">
                        Заполните нужные поля для создания работника.
                        <span class="text-xs">(Заполнять кириллицой)</span>
                    </p>
                </div>

                <form
                    @submit.prevent="submitForm"
                    class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2"
                >
                    <div class="sm:col-span-3">
                        <InputLabel for="name"> Имя </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.name"
                                name="name"
                                id="name"
                                class="w-full"
                            />
                        </div>
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel for="email"> Email </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.email"
                                type="email"
                                name="email"
                                id="email"
                                class="w-full"
                            />
                        </div>
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="sm:col-span-6">
                        <InputLabel for="password"> Пароль </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.password"
                                type="password"
                                name="password"
                                id="password"
                                class="w-full"
                            />
                        </div>
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="sm:col-span-6">
                        <InputLabel for="password_confirmation">
                            Подтвердите Пароль
                        </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.password_confirmation"
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="w-full"
                            />
                        </div>
                        <InputError
                            :message="form.errors.password_confirmation"
                        />
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel for="city"> Город </InputLabel>

                        <div class="mt-2">
                            <select
                                v-model="form.city"
                                id="city"
                                name="city"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                            >
                                <option selected disabled :value="''">
                                    Выбрать город
                                </option>
                                <option
                                    v-for="city in cities"
                                    :key="city.id"
                                    :value="city.id"
                                >
                                    {{ city.name }}
                                </option>
                            </select>
                        </div>
                        <InputError :message="form.errors.city" />
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel for="role"> Роль </InputLabel>

                        <div class="mt-2">
                            <select
                                v-model="form.role"
                                id="role"
                                name="role"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                            >
                                <option selected disabled :value="''">
                                    Выбрать роль
                                </option>
                                <option
                                    v-for="role in roles"
                                    :key="role.value"
                                    :value="role.value"
                                >
                                    {{ role.key }}
                                </option>
                            </select>
                        </div>
                        <InputError :message="form.errors.role" />
                    </div>

                    <div class="sm:col-span-6 mt-1">
                        <PrimaryButton type="submit" class="w-full py-2.5">
                            Создать
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
