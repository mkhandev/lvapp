<script setup>
import { computed } from "vue";
import Box from "@/Components/UI/Box.vue";
import { useForm, router, Link } from "@inertiajs/vue3";
import NProgress from "nprogress";

const props = defineProps({
    listing: Object,
});

const form = useForm({
    images: [],
});

const addFile = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
};

const upload = () => {
    form.post(
        route("realtor.listing.image.store", { listing: props.listing.id }),
        {
            preserveScroll: true,
            onSuccess: () => form.reset("images"),
        }
    );
};

const reset = () => {
    form.reset("images");
    form.clearErrors(); // Clears the errors when the form is reset
};

const canUpload = computed(() => form.images.length);

router.on("progress", (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});

const imageErrors = computed(() => Object.values(form.errors))
</script>

<template>
    <Box>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                    type="file"
                    multiple
                    @input="addFile"
                />
                <button
                    :disabled="!canUpload"
                    type="submit"
                    class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                >
                    Submit
                </button>
                <button type="reset" class="btn-outline" @click="reset">
                    Reset
                </button>
            </section>

            <div v-if="imageErrors.length">
                <div v-for="(errImage, index) in imageErrors" :key="index" class="input-error"> {{ errImage }}</div>
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-4">
        <template #header> Current Listing Images </template>
        <section class="mt-4 grid grid-cols-3 gap-4">
            <div
                v-for="(image, index) in listing.images"
                :key="index"
                class="flex flex-col justify-between"
            >
                <img :src="image.src" class="rounded-md" />
                <Link
                    :href="
                        route('realtor.listing.image.destroy', {
                            listing: listing.id,
                            image: image.id,
                        })
                    "
                    method="delete"
                    as="button"
                    class="mt-2 btn-outline text-xs"
                    >Delete</Link
                >
            </div>
        </section>
    </Box>
</template>

<style></style>
