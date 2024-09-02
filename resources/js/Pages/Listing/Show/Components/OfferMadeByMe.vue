<script setup>
import Box from "@/Components/UI/Box.vue"
import Price from "@/Components/Price.vue";

const props = defineProps({
    offerMade: Object
})

</script>

<template>
    <Box>
        <template #header>Offer Made</template>
        <Price :price="offerMade.amount" class="text-3xl" />
    </Box>
</template>

<style></style>
