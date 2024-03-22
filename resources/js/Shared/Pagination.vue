<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    'links': Array
})
</script>

<template>
    <div class="text-center">
        <Component
            v-for="link in links"
            :is="link.url ? Link : 'span'"
            :href="link.url"
            v-html="link.label"
            class="py-2 px-3 mr-2 border rounded-md"
            :class="{
                'text-gray-400 bg-gray-100 cursor-not-allowed': !link.url,
                'font-bold bg-gray-50': link.active
            }"
            replace
            preserve-scroll
            preseve-state
        />
    </div>
</template>
