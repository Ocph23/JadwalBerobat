<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import LogoPuskesmas from '@/Icons/LogoPuskesmas.vue';
import { Link } from '@inertiajs/vue3';
</script>

<style>
.main-bg {
    background-image: url('../../images/loginbg.jpg');

    /* Full height */
    height: 100vh;
    width: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>

<template>
    <div class="min-h-screen main-bg  flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <Link href="/">
            <LogoPuskesmas class="w-20 h-25 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
