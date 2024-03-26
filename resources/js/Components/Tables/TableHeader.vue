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
        </tr>
    </thead>
</template>
