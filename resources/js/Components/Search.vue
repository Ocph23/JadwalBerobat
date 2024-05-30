<script setup>
import Search from '@/Components/Search.vue';


const search = reactive({ text: '' });
const emit = defineEmits(['onSearch']);


function onChangeText($event){
    emit.apply($event.Target.text);
}





</script>


<template>
    <div class="group relative hidden h-full w-full items-center md:flex lg:w-64">
        <div
            class="absolute flex cursor-pointer items-center justify-center p-3 pr-2 text-sm uppercase text-gray-500 sm:hidden">
            <svg fill="none" class="relative h-5 w-5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                stroke="currentColor" viewBox="0 0 24 24">
                <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div><svg
            class="pointer-events-none absolute left-0 ml-4 hidden h-4 w-4 fill-current text-gray-500 group-hover:text-gray-400 sm:block"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
            </path>
        </svg><input type="text" v-model="search.text" v-on:change="onChangeText"
            class="block w-full rounded-2xl bg-gray-100 py-1.5 pl-10 pr-4 leading-normal text-gray-400 opacity-90 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Search">
        <div
            class="absolute right-0 mr-2 hidden h-auto rounded-2xl border border-gray-300 px-2 py-1 text-xs text-gray-400 md:block">
            + </div>
    </div>
</template>