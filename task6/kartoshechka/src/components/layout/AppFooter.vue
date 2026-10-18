<template>
  <footer class="bg-white py-8 md:py-12">
    <div class="site-container flex flex-col items-center gap-6">
      <p class="m-0 text-[1.375rem] font-extrabold tracking-wide text-text md:text-[1.75rem]">
        {{ brandName }}
      </p>
      <SocialLinks />
    </div>
  </footer>
</template>

<script setup>
import SocialLinks from '@/components/ui/SocialLinks.vue'
import { brandName } from '@/data/content'
</script>
