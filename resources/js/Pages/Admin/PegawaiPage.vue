<script setup>
import Layout from '@/dashboard/Layout.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import DeleteIcon from '@/Icons/DeleteIcon.vue';
import Swal from 'sweetalert2';
import {useForm} from '@inertiajs/vue3'


const props = defineProps({
    data: {
        type: Array
    }
})

const form = useForm({
    id: 0
})

function addNewItem() {
    console.log("siap");
    window.location = "/admin/pegawai/add";

}


function deleteItem(item) {
    Swal.fire({
        title: "Anda Yakin ?",
        text: "Menghapus Data !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('admin.pegawai.delete', item.id), {
                onSuccess: (res) => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Data Berhasil Di hapus.",
                        icon: "success"
                    });

                }, onError: (err) => {
                    Swal.fire({
                        title: "Error",
                        text: err,
                        icon: "error"
                    });
                }
            })


        }
    });
}


</script>



<template>

    <Layout>
        <div class=" mt-5 flex justify-between">
            <h1 class="text-2xl">DATA PEGAWAI</h1>
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
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Kode
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Nama Pegawai
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Jenis Kelamin
                            </th>
                            <th scope="col"
                                class=" w-auto border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Bagian
                            </th>
                            <th scope="col"
                                class=" w-auto border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Kontak
                            </th>
                            <th scope="col"
                                class=" w-20 border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in data">
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.kode }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.nama }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.jk=='pria'?'Laki-Laki':'Perempuan' }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.bagian }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.kontak }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm flex">
                                <a :href="'/admin/pegawai/add/' + item.id" class=" text-amber-500 hover:text-amber-700">
                                    <EditIcon class=" w-5" />
                                </a>
                                <a @click="deleteItem(item)" class=" cursor-pointer text-rose-600 hover:text-rose-900">
                                    <DeleteIcon class=" w-5" />
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </Layout>

</template>