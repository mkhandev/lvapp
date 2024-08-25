<script setup>
import ListingAddress from '@/Component/ListingAddress.vue';



const props = defineProps({
    listing: Object
});
</script>

<template>
<div>
    <ListingAddress :listing="listing" />
</div>
</template>

<style>

</style>