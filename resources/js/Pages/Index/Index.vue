<script setup>
import { ref, defineProps,defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";


const props = defineProps({
    message: String,
});
const counter = ref(0);

setInterval(() => counter.value++, 1000);
</script>



<template>
    <h1>Welcome Home!!! {{ counter }}</h1>
    <h2>{{ message }}</h2>
    <Link href="/hello"
    >Show</Link>
</template>

<style></style>
