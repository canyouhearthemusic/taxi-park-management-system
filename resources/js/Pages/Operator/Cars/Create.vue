<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    cities: Array,
});

const form = useForm({
    firm: "",
    model: "",
    city: "",
    license_plate: "",
});

function submitForm() {
    form.post(route("operator.cars.store"));
}
</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Создать Машину
            </h2>
        </template>

        <div class="py-7 px-4 sm:px-6 lg:px-14">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Создать Машину
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-700">
                        Заполните нужные поля для создания машины.
                        <br>
                        <p class="text-xs">(Заполнять латиницой)</p>
                    </p>
                </div>

                <form
                    @submit.prevent="submitForm"
                    class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2"
                >
                    <div class="sm:col-span-3">
                        <InputLabel for="firm"> Марка </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.firm"
                                name="firm"
                                id="firm"
                                class="w-full"
                            />
                        </div>
                        <InputError :message="form.errors.firm" />
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel for="model"> Модель </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.model"
                                type="text"
                                name="model"
                                id="model"
                                class="w-full"
                            />
                        </div>
                        <InputError :message="form.errors.model" />
                    </div>

                    <div class="sm:col-span-3">
                        <InputLabel for="license_plate"> Гос. Номер </InputLabel>

                        <div class="mt-2">
                            <TextInput
                                v-model="form.license_plate"
                                type="text"
                                name="license_plate"
                                id="license_plate"
                                class="w-full"
                            />
                        </div>
                        <InputError :message="form.errors.license_plate" />
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
