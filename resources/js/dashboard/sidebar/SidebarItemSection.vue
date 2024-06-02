<script setup lang="ts">
defineProps({
  name: {
    type: String,
    default: "",
  },
  subname: {
  },
});
</script>

<template>
  <div class="mt-6 md:pl-6">
    <div>
      <div class="mb-10 flex flex-col">
        <div class="mb-4 pl-5 text-lg font-medium text-white lg:pl-6">
          {{ name }}
        </div>
        <div class="mb-4 pl-5 text-lg font-medium text-white lg:pl-6">
          {{ subname }}
        </div>
        <slot />
      </div>
    </div>
  </div>
</template>
