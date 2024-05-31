<script setup lang="ts">

import SidebarItemSection from '@/dashboard/sidebar/SidebarItemSection.vue';
import SidebarItem from '@/dashboard/sidebar/SidebarItem.vue';
import AllAppIcon from '@/dashboard/sidebar/icons/AllAppIcon.vue';
import UpdatesIcon from '@/dashboard/sidebar/icons/UpdatesIcon.vue';
import PatientIcon from '@/Icons/PatientIcon.vue';
import MedicalIcon from '@/Icons/MedicalIcon.vue';

</script>
<template>
    <div>
      <SidebarItemSection name="Apps">
        <SidebarItem title="Dashboard" to="/dokter">
          <DoctorIcon />
        </SidebarItem>
        <SidebarItem title="Pasien" to="/dokter/pasien">
          <PatientIcon class="w-5 h-5  text-slate-200" />
        </SidebarItem>
        <SidebarItem title="Rekam Medik" to="/dokter/rekammedik">
          <MedicalIcon class="w-5 h-5  text-slate-200" />
        </SidebarItem>
      </SidebarItemSection>
    </div>
  </template>
  