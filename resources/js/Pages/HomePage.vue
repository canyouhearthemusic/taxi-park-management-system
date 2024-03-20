<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Добро пожаловать, {{ $page.props.auth.user.name }}!
            </h2>
        </template>

        <Welcome />
    </AppLayout>
</template>
