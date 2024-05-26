<script setup>
import { ref, computed } from 'vue'



const props = defineProps({
    items: {
        type: Array
    }, 
    value: 0
})



let searchTerm = ref('')
let selected = ref(null);

const selectedItem = (item) => {
    selected.value = item;
    searchTerm.value = item.nama;
    props.value = item.id;
}

const searchCountries = computed(() => {
    if (searchTerm.value === '') {
        return []
    }

    let matches = 0
    selected.value = null;
    return props.items.filter(item => {
        if (
            item.nama.toLowerCase().includes(searchTerm.value.toLowerCase())
            && matches < 10
        ) {
            matches++
            return item
        }
    })
});
</script>



<template>
    <input type="text" placeholder="Type here..." v-model="searchTerm" id="search" class="bg-transparent">
    <ul v-if="searchCountries.length && selected == null">
        <li v-on:click="selectedItem(item)" v-for="item in searchCountries" :key="item.id"
            class=" p-2 bg-zinc-400  opacity-95">
            {{ item.nama }}
        </li>
    </ul>
</template>