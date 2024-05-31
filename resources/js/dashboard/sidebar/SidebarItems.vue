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
</script>

<template>
  <div>
    <SidebarItemSection>
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
        <VideoIcon />
      </SidebarItem>
      <SidebarItem title="Pegawai" to="/admin/pegawai">
        <IllustrationIcon />
      </SidebarItem>
      <SidebarItem title="Pasien" to="/admin/pasien">
        <UxIcon />
      </SidebarItem>
      <SidebarItem title="Rekam Medik" to="/admin/rekammedik">
        <ArIcon />
      </SidebarItem>
    </SidebarItemSection>
  
  </div>
</template>
