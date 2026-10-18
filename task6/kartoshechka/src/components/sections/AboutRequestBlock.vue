<template>
  <div class="relative overflow-hidden">
    <img
      :src="potatoRight"
      alt=""
      class="about-request-potato-right"
      aria-hidden="true"
    />

    <AboutSection />
    <RequestForm />
  </div>
</template>

<script setup>
import AboutSection from '@/components/sections/AboutSection.vue'
import RequestForm from '@/components/sections/RequestForm.vue'
import potatoRight from '@/assets/potato-right.png'
</script>
