<script setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline/index.js";

const props = defineProps({
    id: String,
    name: String,
    placeholder: String,
    search: String,
});

const emit = defineEmits(["update:search"]);
</script>

<template>
    <div class="mx-auto relative flex items-center align-baseline">
        <input
            type="text"
            :name="name"
            :id="name"
            :placeholder="placeholder"
            :value="search"
            @input="$emit('update:search', $event.target.value)"
            class="peer block w-full border-0 py-3 text-gray-800 focus:ring-0 sm:text-sm sm:leading-6 pl-14 rounded-t-md"
        />
        <div
            class="absolute inset-x-0 bottom-0 border-t border-gray-700 peer-focus:border-t-2 peer-focus:border-indigo-600"
            aria-hidden="true"
        />

        <div class="absolute left-3 flex">
            <MagnifyingGlassIcon
                class="inline-block items-center w-6 h-6 text-gray-600"
                >Search</MagnifyingGlassIcon
            >
        </div>
    </div>
</template>
