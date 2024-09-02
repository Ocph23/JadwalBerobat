<script setup lang="ts">

const prop = defineProps({
  poli: {
    type: Poli,
    default: ''
  }
});

const emit = defineEmits(['titleChange']);

import SidebarItemSection from '@/dashboard/sidebar/SidebarItemSection.vue';
import SidebarItem from '@/dashboard/sidebar/SidebarItem.vue';
import AllAppIcon from '@/dashboard/sidebar/icons/AllAppIcon.vue';
import UpdatesIcon from '@/dashboard/sidebar/icons/UpdatesIcon.vue';
import PatientIcon from '@/Icons/PatientIcon.vue';
import MedicalIcon from '@/Icons/MedicalIcon.vue';
import Poli from '@/Models/Poli';
import { onMounted } from 'vue';
import Pasien from '@/Models/Pasien';

onMounted(() => {
    emit('titleChange', prop.poli.nama);
})


</script>
<template>
  <div >
    <SidebarItemSection name="POLI" :subname="prop.poli.nama">
      <SidebarItem title="Rekam Medik" to="/pasien">
        <AllAppIcon class=" text-black" />
      </SidebarItem>
    </SidebarItemSection>
  </div>
</template>