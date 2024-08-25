<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Component/ListingAddress.vue";
const props = defineProps({
    listings: Array,
});
</script>

<template>
    <div v-for="listing in listings" :key="listing.id">
        <div>
            <Link :href="route('listing.show', { listing: listing.id })">
                <ListingAddress :listing="listing" />
            </Link>
        </div>
        <div>
            <Link :href="route('listing.edit', { listing: listing.id })"> Edit </Link>
        </div>
        <div>
            <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE">Delete</Link>
        </div>
    </div>
</template>

<style></style>
