<script setup>
import { computed, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import { debounce } from "lodash";

const props = defineProps({
    listingId: Number,
    price: Number,
});
const form = useForm({
    amount: props.price,
});
const difference = computed(() => form.amount - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));

const makeOffer = () => {
    form.post(route("listing.offer.store", { listing: props.listingId }));
};

const emit = defineEmits(["offerUpdated"]);

watch(
    () => form.amount,
    debounce((value) => emit("offerUpdated", value), 200)
);
</script>

<template>
    <Box>
        <template #header>Make an offer</template>
        <div>
            <form @submit.prevent="makeOffer">
                <input
                    v-model.number="form.amount"
                    type="text"
                    class="input mb-3"
                />
                <input
                    v-model.number="form.amount"
                    type="range"
                    :min="min"
                    :max="max"
                    step="90"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                />

                <button type="submit" class="btn-outline w-full mt-3 text-sm">
                    Make an Offer
                </button>

                <div class="input-error mt-2 mb-1" v-if="form.errors.amount">
                    {{ form.errors.amount }}
                </div>
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<style></style>
