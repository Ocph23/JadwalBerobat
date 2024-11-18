<script setup>

import PoliLayout from "@/Layouts/PoliLayout.vue";
import Pasien from "@/Models/Pasien";
import EditIcon from "@/Icons/EditIcon.vue";
import DeleteIcon from "@/Icons/DeleteIcon.vue";
import AddIcon from "@/Icons/AddIcon.vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import Poli from '@/Models/Poli';
import Pegawai from '@/Models/Pegawai';
import RekamMedik from "@/Models/RekamMedik";
import { computed } from "vue";

const props = defineProps({
   pegawai: {
      type: Pegawai
   },
   poli: {
      type:Poli
   },
   rekammedik: {
      type : Array
   },
})

console.log(props);
const form = useForm({
    id: 0
})


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
            form.delete(route('pasien.rekammedik.delete', item.id), {
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


const filterDataRekamMedik = computed(() => {
    return props.rekammedik.sort(function (a, b) {
        return new Date(b.tanggal) - new Date(a.tanggal);
    });


});
</script>


<template>
     <PoliLayout :poli="props.poli">
        <div class=" mt-5 flex justify-between">
            <h1 class="text-xl">DATA REKAM MEDIK</h1>
        </div>
        <div class="py-5">
            <div class="max-w-full overflow-x-auto rounded-lg shadow">
                <table class="w-full leading-normal">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Kode Antrian
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Tanggal
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
                                class=" w-auto border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Status
                            </th>
                            <th scope="col"
                                class=" w-20 border-b border-gray-200  px-5 py-3 text-left text-sm font-normal uppercase text-neutral-500">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in filterDataRekamMedik">
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap">{{ item.antrian }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap">{{ item.tanggal }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap">{{ item.poli.nama }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap capitalize">{{ item.dokter.nama }}</p>
                            </td>
                            <td class="border-b border-gray-200  p-3 text-sm">
                                <p class="whitespace-nowrap capitalize">{{ item.status }}</p>
                            </td>

                            <td class="border-b border-gray-200  p-3 text-sm flex" v-if="item.status=='baru' || item.status=='poli'">
                                <a :href="'/poli/rekammedik/' + item.id" class=" text-amber-500 hover:text-amber-700">
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
    </PoliLayout>

</template>
