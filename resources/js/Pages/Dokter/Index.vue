<script setup>
import DokterLayout from "@/Layouts/DokterLayout.vue";
import Poli from "@/Models/Poli";

const props = defineProps({
   poli:{
      type:Poli
   }
})


</script>

<template>
   <DokterLayout :poli="props.poli">
      <h1>DOKTER PAGE</h1>
   </DokterLayout>
</template>
