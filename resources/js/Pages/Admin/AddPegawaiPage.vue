<script setup>
import Layout from '@/dashboard/Layout.vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';
import Pegawai from '@/Models/Pegawai';


const props = defineProps({
    pegawai: {
        type: Pegawai
    }
})


const form = useForm({
    "id": 0,
    "kode": '',
    "nama": '',
    "jk": '',
    "bagian": '',
    "kontak": '',
}
)


function addNewItem() {
    console.log("siap");
    window.location = "/admin/pegawai/add";
}


function backAction(params) {
    window.location = "/admin/pegawai";
}

const save = () => {

    if (form.id <= 0) {
        form.post(route('admin.pegawai.post'), {
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
                console.log(err);
            }
        });
    } else {
        form.put(route('admin.pegawai.put', form.id), {
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
                console.log(err);
            }
        });
    }
}


onMounted(() => {
    if (props.pegawai) {
        form.id = props.pegawai.id;
        form.kode = props.pegawai.kode;
        form.nama = props.pegawai.nama;
        form.jk = props.pegawai.jk;
        form.bagian = props.pegawai.bagian;
        form.kontak = props.pegawai.kontak;
    }

})

</script>

<template>

    <Layout>
        <div class="p-5 mt-5 flex justify-between">
            <h1 class="text-2xl">Pegawai</h1>
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
                                <label class="mb-2">Nama Pegawai</label>
                                <input type="text" v-model="form.nama"
                                    class=" rounded-lg bg-transparent  text-neutral-400 ">
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Jenis Kelamin</label>
                                <select type="text" v-model="form.jk" required
                                    class="rounded-lg bg-transparent  text-neutral-400">
                                    <option value="pria">Laki-Laki</option>
                                    <option value="wanita">Perempuan</option>
                                </select>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Bagian</label>
                                <input type="text" v-model="form.bagian"
                                    class=" rounded-lg bg-transparent  text-neutral-400">
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Kotak</label>
                                <input type="text" v-model="form.kontak"
                                    class=" rounded-lg bg-transparent  text-neutral-400">
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
    </Layout>

</template>