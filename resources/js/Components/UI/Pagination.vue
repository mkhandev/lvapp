<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    link: Object,
});
</script>

<template>
    <Link
        :href="link.url ? link.url : '#'"
        v-html="link.label"
        class="py-1 px-3 rounded-md"
        :class="{
            'bg-indigo-500 dark:bg-indigo-800  text-gray-300': link.active,
        }"
    ></Link>
</template>

<style></style>
