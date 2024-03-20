<script setup>
defineProps({
    headers: Array,
});
</script>

<template>
    <thead>
        <tr>
            <th
                v-for="header in headers"
                scope="col"
                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
            >
                {{ header }}
            </th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                <span class="sr-only">Править</span>
            </th>
        </tr>
    </thead>
</template>
