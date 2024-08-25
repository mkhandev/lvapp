<template>
    <span>
      {{ listing.street }} {{ listing.street_nr }}, {{
        listing.city }}, for ${{ listing.price }}
    </span>
  </template>
  
  <script setup>
  const props = defineProps({
    listing: Object,
  })
  </script>