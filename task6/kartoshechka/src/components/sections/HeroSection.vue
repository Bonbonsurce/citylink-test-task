<template>
  <section class="hero" aria-label="Главный экран">
    <div class="hero__bg" :style="{ backgroundImage: `url(${heroBg})` }" />
    <div class="hero__overlay" />
    <div class="hero__content container">
      <h1 class="hero__title hero__title--desktop">{{ heroTitleDesktop }}</h1>
      <h1 class="hero__title hero__title--mobile" aria-hidden="true">
        <span v-for="(line, index) in heroTitleMobileLines" :key="index">{{ line }}</span>
      </h1>
    </div>
  </section>
</template>

<script setup>
import heroBg from '@/assets/hero-bg.png'
import { heroTitleDesktop, heroTitleMobileLines } from '@/data/content'
</script>
