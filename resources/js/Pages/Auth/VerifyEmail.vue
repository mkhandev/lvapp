<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <h1>You need to verified first to see this page!</h1>
    <div>
        <Link
            :href="route('verification.send')"
            method="post"
            as="button"
            class="text-indigo-600 dark:text-indigo-400"
            >Resend verification email</Link
        >
    </div>
</template>

<style></style>
