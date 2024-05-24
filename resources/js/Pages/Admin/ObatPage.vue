<script setup>
import Layout from '@/dashboard/Layout.vue';


const props = defineProps({
    data: {
        type: Array
    }
})



function addNewItem() {
    console.log("siap");
    window.location = "/admin/obat/add";

}

</script>



<template>

    <Layout>
        <div class=" mt-5 flex justify-between">
            <h1 class="text-2xl">DATA OBAT</h1>
            <button @click="addNewItem()"
                class="shrink-0 rounded-lg bg-gray-600 px-4 py-2 text-base font-semibold text-white shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200"
                type="submit">
                Tambah
            </button>
        </div>
        <div class="py-5">
            <div class="max-w-full overflow-x-auto rounded-lg shadow">
                <table class="w-full leading-normal">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="border-b border-gray-200 bg-white px-5 py-3 text-left text-sm font-normal uppercase text-gray-800">
                                User
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200 bg-white px-5 py-3 text-left text-sm font-normal uppercase text-gray-800">
                                Role
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200 bg-white px-5 py-3 text-left text-sm font-normal uppercase text-gray-800">
                                Created at
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200 bg-white px-5 py-3 text-left text-sm font-normal uppercase text-gray-800">
                                status
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200 bg-white px-5 py-3 text-left text-sm font-normal uppercase text-gray-800" />
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in data">
                            <td class="border-b border-gray-200 bg-white p-5 text-sm">
                                <p class="whitespace-nowrap text-gray-900">{{item.nama}}</p>
                            </td>
                            <td class="border-b border-gray-200 bg-white p-5 text-sm">
                                <p class="whitespace-nowrap text-gray-900">12/09/2020</p>
                            </td>
                            
                            <td class="border-b border-gray-200 bg-white p-5 text-sm">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </Layout>

</template>