<template>
  <section class="relative flex min-h-screen items-center justify-center overflow-hidden" aria-label="Главный экран">
    <div
      class="absolute inset-0 bg-cover bg-center bg-no-repeat"
      :style="{ backgroundImage: `url(${heroBg})` }"
    />
    <div
      class="absolute inset-0 bg-[rgba(62,58,32,0.62)] bg-gradient-to-b from-[rgba(78,72,40,0.55)] to-[rgba(55,50,28,0.5)]"
    />
    <div class="site-container relative z-[1] w-full pb-20 pt-header text-center">
      <h1
        class="hidden font-extrabold leading-none tracking-wide text-white md:block md:text-[clamp(3rem,8vw,6rem)]"
      >
        {{ heroTitleDesktop }}
      </h1>
      <h1
        class="flex flex-col items-start pl-3 text-left text-[clamp(4rem,20vw,5.75rem)] font-extrabold uppercase leading-none tracking-wide text-white md:hidden"
        aria-hidden="true"
      >
        <span v-for="(line, index) in heroTitleMobileLines" :key="index">{{ line }}</span>
      </h1>
    </div>
  </section>
</template>

<script setup>
import heroBg from '@/assets/hero-bg.png'
import { heroTitleDesktop, heroTitleMobileLines } from '@/data/content'
</script>
