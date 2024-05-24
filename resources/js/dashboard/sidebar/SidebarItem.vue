<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
import { useRoute } from "vue-router";

defineProps({
  to: {
    type: String,
    default: "",
  },
  title: {
    type: String,
    default: "",
  },
});
//const route = useRoute();
</script>

<template>

<NavLink :href="to">
    <span
    class="my-1 flex w-full items-center justify-start p-3 text-white"
    >
    <span>
      <slot />
    </span>
    <span class="mx-4 text-sm">
      {{ title }}
    </span>
  </span>
</NavLink>
</template>
