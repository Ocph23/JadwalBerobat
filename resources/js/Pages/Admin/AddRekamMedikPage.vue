<script setup>
import Layout from '@/dashboard/Layout.vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';
import AutoComplete from '@/Components/AutoComplete.vue';


const props = defineProps({
    dokters: {
        type: Array
    },
    polis: {
        type: Array
    },
    pasiens: {
        type: Array
    }
})


const form = useForm({
    "id": 0,
    "kode": '',
    "nama": '',
    "keterangan": '',
    "dokter_id": '',
}
)


function addNewItem() {
    console.log("siap");
    window.location = "/admin/poli/add";
}


function backAction(params) {
    window.location = "/admin/poli";
}

const save = () => {

    if (form.id <= 0) {
        form.post(route('admin.poli.post'), {
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
        form.put(route('admin.poli.put', form.id), {
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
    if (props.poli) {
        form.id = props.poli.id;
        form.kode = props.poli.kode;
        form.nama = props.poli.nama;
        form.keterangan = props.poli.keterangan;
        form.dokter_id = props.poli.dokter_id;
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
                              <AutoComplete :value="form.pasien_id" :items="pasiens"></AutoComplete>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Nama Poli</label>
                                <select type="text" v-model="form.poli_id"
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
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Keterangan</label>
                                <textarea v-model="form.keterangan"
                                    class=" rounded-lg bg-transparent  text-neutral-400"></textarea>
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