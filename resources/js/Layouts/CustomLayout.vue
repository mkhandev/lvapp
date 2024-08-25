<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
</script>

<template>
    <div>
        <header>
            <h1>Custom Layout Header Section</h1>
        </header>

        <article>
            <slot>Default Content</slot>
        </article>

        <footer>
            <h1>Custom Layout Footer Section</h1>
        </footer>
    </div>
</template>

<style scoped>
.success {
    background: green;
    color: white;
}
</style>
