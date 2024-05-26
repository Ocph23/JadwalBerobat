<script setup lang="ts">

import SidebarItemSection from '@/dashboard/sidebar/SidebarItemSection.vue';
import SidebarItem from '@/dashboard/sidebar/SidebarItem.vue';
import AllAppIcon from '@/dashboard/sidebar/icons/AllAppIcon.vue';
import UpdatesIcon from '@/dashboard/sidebar/icons/UpdatesIcon.vue';

</script>
<template>
    <div>
      <SidebarItemSection name="Apps">
        <SidebarItem title="Dashboard" to="/dokter">
          <AllAppIcon />
        </SidebarItem>
        <SidebarItem title="Pasien" to="/dokter/pasien">
          <UpdatesIcon />
        </SidebarItem>
        <SidebarItem title="Rekam Medik" to="/dokter/rekammedik">
          <UpdatesIcon />
        </SidebarItem>
      </SidebarItemSection>
    </div>
  </template>
  