<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
});

const login = () => form.post(route("login.store"));
</script>

<template>
    <form @submit.prevent="login">
        <div class="w-1/3 mt-3 mx-auto">
            <div
                v-if="form.errors.invalidLogin"
                class="bg-red-500 text-white p-1 mt-1 mb-2 text-center"
            >
                {{ form.errors.invalidLogin }}
            </div>
            <div>
                <label for="email" class="label">E-mail (username)</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="input"
                    autocomplete="false"
                />
                <div class="input-error" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="input"
                    autocomplete="false"
                />
                <div class="input-error" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Login</button>

                <div class="mt-2 text-center">
                    <Link
                        :href="route('user-account.create')"
                        class="text-sm text-gray-500"
                    >
                        Need an account? Click here
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>

<style></style>
