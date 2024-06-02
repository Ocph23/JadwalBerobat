<script setup lang="ts">
import UxIcon from "./icons/UxIcon.vue";
import ArIcon from "./icons/ArIcon.vue";
import DocIcon from "./icons/DocIcon.vue";
import SidebarItem from "./SidebarItem.vue";
import VideoIcon from "./icons/VideoIcon.vue";
import AllAppIcon from "./icons/AllAppIcon.vue";
import UpdatesIcon from "./icons/UpdatesIcon.vue";
import SidebarItemSection from "./SidebarItemSection.vue";
import PhotographyIcon from "./icons/PhotographyIcon.vue";
import IllustrationIcon from "./icons/IllustrationIcon.vue";
import GraphicDesignIcon from "./icons/GraphicDesignIcon.vue";
import DoctorIcon from "@/Icons/DoctorIcon.vue";
import PatientIcon from "@/Icons/PatientIcon.vue";
import DetailListIcon from "@/Icons/DetailListIcon.vue";
</script>

<template>
  <div>
    <SidebarItemSection name="APP ADMIN" :subname="$page.props.auth.user.name">
      <SidebarItem title="Dashboard" to="/admin">
        <AllAppIcon />
      </SidebarItem>
      <SidebarItem title="Obat" to="/admin/obat">
        <PhotographyIcon />
      </SidebarItem>
      <SidebarItem title="Poli" to="/admin/poli">
        <GraphicDesignIcon />
      </SidebarItem>
      <SidebarItem title="Dokter" to="/admin/dokter">
        <DoctorIcon class=" w-5  h-auto" />
      </SidebarItem>
      <SidebarItem title="Pegawai" to="/admin/pegawai">
        <IllustrationIcon />
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
