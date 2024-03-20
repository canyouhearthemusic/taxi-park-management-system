<script setup></script>

<template>
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
            <slot name="header" />

            <slot />
        </table>
    </div>
</template>
