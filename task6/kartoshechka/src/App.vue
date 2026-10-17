<template>
  <div class="app">
    <AppHeader
      :active-section="activeSection"
      @toggle-menu="menuOpen = true"
      @navigate="onNavigate"
    />
    <MobileMenu
      :open="menuOpen"
      @close="menuOpen = false"
      @navigate="onNavigate"
    />

    <main>
      <HeroSection />
      <PricesSection />
      <VideoSection />
      <AboutRequestBlock />
    </main>

    <AppFooter />
  </div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import AppHeader from '@/components/layout/AppHeader.vue'
import MobileMenu from '@/components/layout/MobileMenu.vue'
import AppFooter from '@/components/layout/AppFooter.vue'
import HeroSection from '@/components/sections/HeroSection.vue'
import PricesSection from '@/components/sections/PricesSection.vue'
import VideoSection from '@/components/sections/VideoSection.vue'
import AboutRequestBlock from '@/components/sections/AboutRequestBlock.vue'

const menuOpen = ref(false)
const activeSection = ref('')

const sectionIds = ['prices', 'video', 'about', 'request']

function updateActiveSection() {
  const offset = 120
  let current = ''

  for (const id of sectionIds) {
    const el = document.getElementById(id)
    if (el && el.getBoundingClientRect().top <= offset) {
      current = id
    }
  }

  activeSection.value = current
}

function onNavigate(href) {
  const id = href.replace('#', '')
  if (sectionIds.includes(id)) {
    activeSection.value = id
  }
}

onMounted(() => {
  window.addEventListener('scroll', updateActiveSection, { passive: true })
  updateActiveSection()
})

onUnmounted(() => {
  window.removeEventListener('scroll', updateActiveSection)
})
</script>