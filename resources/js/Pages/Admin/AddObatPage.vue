<script setup>
import Layout from '@/dashboard/Layout.vue';
import { useForm } from '@inertiajs/vue3';




const form = useForm({
    "id": 0,
    "kode": '',
    "nama": '',
    "merek": '',
    "dosis": '',
    "deskripsi": '',
    "kemasan": '',
    "exp": new Date(),
}
)


function addNewItem() {
    console.log("siap");
    window.location = "/admin/obat/add";
}


function backAction(params) {
    window.location = "/admin/obat";
}

const save = () => {
    form.post(route('admin.obat.post'), {
        onSuccess: (res) => {
            console.log(res);
        },
        onError: (err) => {
                console.log(err);
        }
    });
}

</script>

<template>

    <Layout>
        <div class="p-5 mt-5 flex justify-between">
            <h1 class="text-2xl"> OBAT</h1>
        </div>
        <div class="p-5">
            <div class="max-w-full overflow-x-auto rounded-lg shadow ">
                <form class="flex flex-col lg:w-1/2" @submit.prevent="save">
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Kode</label>
                        <input type="text" v-model="form.kode" class=" rounded-lg bg-transparent  text-neutral-400">
                    </div>
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Nama Obat</label>
                        <input type="text" v-model="form.nama" class=" rounded-lg bg-transparent  text-neutral-400 ">
                    </div>
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Merek</label>
                        <input type="text" v-model="form.merek" required
                            class="rounded-lg bg-transparent  text-neutral-400">
                    </div>
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Dosis</label>
                        <input type="text" v-model="form.dosis" class=" rounded-lg bg-transparent  text-neutral-400">
                    </div>
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Deskripsi</label>
                        <input type="text" v-model="form.deskripsi"
                            class=" rounded-lg bg-transparent  text-neutral-400">
                    </div>
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Kemasan</label>
                        <input type="text" v-model="form.kemasan" class=" rounded-lg bg-transparent  text-neutral-400">
                    </div>
                    <div class="flex flex-col p-3">
                        <label class="mb-2">Expire</label>
                        <input type="date" v-model="form.exp" class=" rounded-lg bg-transparent  text-neutral-400">
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