<script setup>
import Layout from '@/dashboard/Layout.vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';
import Pasien from '@/Models/Pasien';
import InputError from '@/Components/InputError.vue';
import Helper from '@/heper';


const props = defineProps({
    pasien: {
        type:Pasien
    }
})


const form = useForm({
    "id": 0,
    "nik": '',
    "email": '',
    "nama": '',
    "jk": 'pria',
    "tempat_lahir": '',
    "tanggal_lahir":null,
    "kontak": '',
    "alamat": '',
}
)


function addNewItem() {
    console.log("siap");
    window.location = "/admin/pasien/add";
}


function backAction(params) {
    window.location = "/admin/pasien";
}

const save = () => {

    if (form.id <= 0) {
        form.post(route('admin.pasien.post'), {
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
                if (err.message) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: err.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    } else {
        form.put(route('admin.pasien.put', form.id), {
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
                if (err.message) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: err.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }
}


onMounted(() => {
    if (props.pasien) {
        form.id = props.pasien.id;
        form.kode = Helper.getKode(props.pasien.id,'Pasien');
        form.nik = props.pasien.nik;
        form.nama = props.pasien.nama;
        form.email = props.pasien.email;
        form.jk = props.pasien.jk;
        form.tempat_lahir = props.pasien.tempat_lahir;
        form.tanggal_lahir = props.pasien.tanggal_lahir;
        form.kontak = props.pasien.kontak;
        form.alamat = props.pasien.alamat;
    }

})

</script>

<template>

    <Layout>
        <div class="p-5 mt-5 flex justify-between">
            <h1 class="text-xl"> Pasien</h1>
        </div>
        <div class="p-5">
            <div class="max-w-full overflow-x-auto rounded-lg shadow ">
                <form @submit.prevent="save">
                    <div class=" grid grid-cols-2">
                        <div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">NIK</label>
                                <input type="text" v-model="form.nik" required
                                    class=" rounded-lg bg-transparent  text-neutral-700">
                                    <InputError :message="form.errors['nik']"/>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Nama Pasien</label>
                                <input type="text" v-model="form.nama" required
                                    class=" rounded-lg bg-transparent  text-neutral-700 ">
                                    <InputError :message="form.errors['nama']"/>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Email</label>
                                <input type="text" v-model="form.email" required
                                    class=" rounded-lg bg-transparent  text-neutral-700 ">
                                    <InputError :message="form.errors['email']"/>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Jenis Kelamin</label>
                                <select type="text" v-model="form.jk" required
                                    class="rounded-lg bg-transparent  text-neutral-700">
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                                <InputError :message="form.errors['jk']"/>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Tempat Lahir</label>
                                <input type="text" v-model="form.tempat_lahir" required
                                    class=" rounded-lg bg-transparent  text-neutral-700">
                                    <InputError :message="form.errors['tempat_lahir']"/>
                            </div>
                        </div>
                        <div>

                            <div class="flex flex-col p-3">
                                <label class="mb-2">Tanggal Lahir</label>
                                <input type="date" v-model="form.tanggal_lahir" required
                                    class=" rounded-lg bg-transparent  text-neutral-700">
                                    <InputError :message="form.errors['tanggal_lahir']"/>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Kotak</label>
                                <input type="text" v-model="form.kontak" required
                                    class=" rounded-lg bg-transparent  text-neutral-700">
                                    <InputError :message="form.errors['kontak']"/>
                            </div>
                            <div class="flex flex-col p-3">
                                <label class="mb-2">Alamat</label>
                                <textarea v-model="form.alamat"
                                    class=" rounded-lg bg-transparent  text-neutral-700"></textarea>
                                    <InputError :message="form.errors['alamat']"/>
                            </div>
                        </div>
                    </div>
                    <div class="m-2 flex justify-end">
                        <button type="button" @click="backAction()"
                            class="mx-1 rounded-full border  border-rose-300 px-5 py-1 text-white  bg-rose-500">Kembali</button>
                        <button type="submit"
                            class=" mx-1 rounded-full border  border-sky-500 px-5 py-1  text-white bg-sky-700">Simpan</button>

                    </div>
                </form>
            </div>
        </div>


      
    </Layout>

</template>