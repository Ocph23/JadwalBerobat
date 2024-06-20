<script setup>

import DokterLayout from "@/Layouts/DokterLayout.vue";
import Poli from "@/Models/Poli";
import CapsulesIcon from "@/Icons/CapsulesIcon.vue";
import MedicalIcon from "@/Icons/MedicalIcon.vue";
import HospitalIcon from "@/Icons/HospitalIcon.vue";
import DoctorIcon from "@/Icons/DoctorIcon.vue";
import PatientIcon from "@/Icons/PatientIcon.vue";
import Layout from "@/dashboard/Layout.vue";
import UsersIcon from "@/Icons/UsersIcon.vue";
import ArIcon from "@/dashboard/sidebar/icons/ArIcon.vue"
import DashboarItem from "@/Components/DashboarItem.vue";
import PasienLayout from "@/Layouts/PasienLayout.vue";
import Pasien from "@/Models/Pasien";


const props = defineProps({
   pasien: {
      type: Pasien
   },
   rekammedik: {
      type : Array
   },
})




</script>


<template>
     <PasienLayout :poli="props.poli">
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
    </PasienLayout>

</template>
