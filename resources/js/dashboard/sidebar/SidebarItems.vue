<script setup lang="ts">
import ArIcon from "./icons/ArIcon.vue";
import SidebarItem from "./SidebarItem.vue";
import AllAppIcon from "./icons/AllAppIcon.vue";
import SidebarItemSection from "./SidebarItemSection.vue";
import DoctorIcon from "@/Icons/DoctorIcon.vue";
import PatientIcon from "@/Icons/PatientIcon.vue";
import DetailListIcon from "@/Icons/DetailListIcon.vue";
import CapsulesIcon from "@/Icons/CapsulesIcon.vue";
import HospitalIcon from "@/Icons/HospitalIcon.vue";
import UsersIcon from "@/Icons/UsersIcon.vue";
</script>

<template>
  <div>
    <SidebarItemSection name="APP ADMIN" :subname="$page.props.auth.user.name">
      <SidebarItem title="Dashboard" to="/admin">
        <AllAppIcon />
      </SidebarItem>
      <SidebarItem title="Obat" to="/admin/obat">
        <CapsulesIcon color="white" class="w-5 h-5"/>
      </SidebarItem>
      <SidebarItem title="Poli" to="/admin/poli">
        <HospitalIcon color="white" class="w-5 h-5"/>
      </SidebarItem>
      <SidebarItem title="Dokter" to="/admin/dokter">
        <DoctorIcon class=" w-5  h-auto" />
      </SidebarItem>
      <SidebarItem title="Pegawai" to="/admin/pegawai">
        <UsersIcon class="w-5 h-5" />
      </SidebarItem>
      <SidebarItem title="Pasien" to="/admin/pasien">
        <PatientIcon class="w-5 h-auto" />
      </SidebarItem>
      <SidebarItem title="Rekam Medik" to="/admin/rekammedik">
        <ArIcon />
      </SidebarItem>
      <SidebarItem title="Laporan Jadwal Berobat" to="/admin/jadwalberobat">
        <DetailListIcon class="w-5" />
      </SidebarItem>
    </SidebarItemSection>
  
  </div>
</template>
