<script setup>
import {ref} from "vue"
const counter  = ref(0)

setInterval(() => counter.value ++, 1000)
</script>

<template>
  <h1>Welcome Home!!! {{ counter }}</h1>
</template>

<style>

</style>