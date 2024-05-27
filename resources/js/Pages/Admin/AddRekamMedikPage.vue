<script setup>
import Layout from '@/dashboard/Layout.vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted, } from 'vue';
import AutoComplete from '@/Components/AutoComplete.vue';
import RekamMedik from '@/Models/RekamMedik';
import Pasien from '@/Models/Pasien';


const props = defineProps({
    dokters: {
        type: Array
    },
    polis: {
        type: Array
    },
    pasiens: {
        type: Array,
    },
    rekammedik: RekamMedik
})



const form = useForm({
    "id": 0,
    "kode": '',
    "nama": '',
    "dokter_id": '',
    "pasien_id": '',
    "poli_id": 0,
    "tanggal": new Date().toISOString().split('T')[0]
}
)


function addNewItem() {
    console.log("siap");
    window.location = "/admin/rekammedik/add";
}


function backAction(params) {
    window.location = "/admin/rekammedik";
}

function onChange(event) {

    if (props.rekammediks) {
        var poli = props.rekammediks.find(x => x.id == event.target.value);
        if (poli) {
            form.dokter_id = poli.dokter_id;
        }
    }
}


const save = () => {

    if (form.id <= 0) {
        form.post(route('admin.rekammedik.post'), {
            onSuccess: (res) => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data Berhasil Disimpan ",
                    showConfirmButton: false,
                    timer: 1500
                });
                form.reset();
            },
            onError: (err) => {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: err,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    } else {
        form.put(route('admin.rekammedik.put', form.id), {
            onSuccess: (res) => {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data Berhasil Disimpan ",
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            onError: (err) => {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: err.msg,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
}


const selectPasien = (pasien) => {
    form.pasien_id = pasien.id;
}


onMounted(() => {


    if (props.rekammedik) {
        form.id = props.rekammedik.id;
        form.kode = props.rekammedik.kode;
        form.pasien_id = props.rekammedik.pasien_id;
        form.dokter_id = props.rekammedik.dokter_id;
        form.poli_id = props.rekammedik.poli_id;
        form.tanggal = props.rekammedik.tanggal;
    }
})

</script>

<template>

    <Layout>
        <div class="p-5 mt-5 flex justify-between">
            <h1 class="text-2xl">TAMBAH/EDIT REKAM MEDIK</h1>
        </div>
        <div class="p-5">
            <div class="max-w-full overflow-x-auto rounded-lg shadow ">
                <form @submit.prevent="save">
                    <div class=" grid grid-cols-2">
                        <div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Kode</label>
                                <input type="text" v-model="form.kode"
                                    class=" rounded-lg bg-transparent  text-neutral-400">
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Pasien</label>
                                <AutoComplete v-on:on-select-pasien="selectPasien" :value="form.pasien_id"
                                    :pasiens="props.pasiens"></AutoComplete>
                            </div>

                        </div>
                        <div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Nama Poli</label>
                                <select type="text" v-model="form.poli_id" @change="onChange($event)"
                                    class=" rounded-lg bg-transparent  text-neutral-400 ">
                                    <option :value="item.id" v-for="item in polis">{{ item.nama }}</option>
                                </select>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Dokter</label>
                                <select type="text" v-model="form.dokter_id" required
                                    class="rounded-lg bg-transparent  text-neutral-400">
                                    <option :value="item.id" v-for="item in dokters">{{ item.nama }}</option>
                                </select>
                            </div>
                            <div class="m-2 flex justify-end">
                                <button type="button" @click="backAction()"
                                    class="mx-1 rounded-full border  border-rose-300 px-5 py-1 text-white  bg-rose-500">Kembali</button>
                                <button type="submit"
                                    class=" mx-1 rounded-full border  border-sky-500 px-5 py-1  text-white bg-sky-700">Simpan</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="form.id > 0">
            <div class="p-5 mt-5 flex justify-between">
                <h1 class="text-2xl">KELUHAN</h1>
            </div>

        </div>

    </Layout>

</template>