<script setup>
import DokterLayout from '@/Layouts/DokterLayout.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import DeleteIcon from '@/Icons/DeleteIcon.vue';
import Swal from 'sweetalert2';
import { useForm } from '@inertiajs/vue3'
import Helper from '@/heper';
import RekamMedik from '@/Models/RekamMedik';
import Poli from '@/Models/Poli';


const props = defineProps({
    data: {
        type: Array
    },
    poli: { type: Poli }
})

const form = useForm({
    id: 0
})

function addNewItem() {
    console.log("siap");
    window.location = "/admin/rekammedik/add";

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
            form.delete(route('admin.rekammedik.delete', item.id), {
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

    <DokterLayout :poli="props.poli">
        <div class=" mt-5 flex justify-between">
            <h1 class="text-2xl">DATA REKAM MEDIK</h1>
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
                                Tanggal
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Pasien
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Poli
                            </th>
                            <th scope="col"
                                class=" w-auto border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Dokter
                            </th>
                            <th scope="col"
                                class=" w-20 border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in data">
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ Helper.getKode(item.id, 'RekamMedik') }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.tanggal }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.pasien.nama }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.poli.nama }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap text-white">{{ item.dokter.nama }}</p>
                            </td>

                            <td class="border-b border-gray-200  p-3 text-sm flex">
                                <a :href="'/dokter/rekammedik/' + item.id" class=" text-amber-500 hover:text-amber-700">
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
    </DokterLayout>

</template>