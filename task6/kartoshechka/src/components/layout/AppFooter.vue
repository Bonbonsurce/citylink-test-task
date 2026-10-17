<template>
  <footer class="app-footer">
    <div class="container app-footer__inner">
      <p class="app-footer__brand">{{ brandName }}</p>
      <SocialLinks />
    </div>
  </footer>
</template>

<script setup>
import SocialLinks from '@/components/ui/SocialLinks.vue'
import { brandName } from '@/data/content'
</script>
