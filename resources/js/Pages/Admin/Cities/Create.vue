<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: "",
    region: "",
});

function submitForm() {
    form.post(route("admin.cities.store"));
}
</script>

<template>
    <AppLayout title="Создать Город">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Создать Город
            </h2>
        </template>

        <div class="py-7 px-4 sm:px-6 lg:px-14">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Создать Город
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-700">
                        Заполните нужные поля для создания города.
                        <span class="text-xs">(Заполнять кириллицой)</span>
                    </p>
                </div>

                <form
                    class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2"
                    @submit.prevent="submitForm"
                >
                    <div class="sm:col-span-3">
                        <InputLabel for="name"> Имя </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                id="name"
                                name="name"
                                class="w-full"
                                v-model="form.name"
                            />
                        </div>

                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel for="region"> Регион </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                id="region"
                                name="region"
                                class="w-full"
                                v-model="form.region"
                            />
                        </div>

                        <InputError :message="form.errors.region" />
                    </div>

                    <div class="sm:col-span-6">
                        <PrimaryButton type="submit" class="w-full py-2.5">
                            Создать
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
