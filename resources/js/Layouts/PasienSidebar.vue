<script setup lang="ts">

const prop = defineProps({
  pasien: {
    type: Pasien,
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
    emit('titleChange', prop.pasien.nama);
})


</script>
<template>
  <div>
    <SidebarItemSection name="APLIKASI PASIEN" :subname="prop.pasien.nama">
      <SidebarItem title="Rekam Medik" to="/pasien">
        <AllAppIcon />
      </SidebarItem>
    </SidebarItemSection>
  </div>
</template>