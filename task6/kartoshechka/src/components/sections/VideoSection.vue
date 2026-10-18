<template>
  <section id="video">
    <div
      class="bg-dark px-5 py-10 max-md:mx-4 max-md:rounded-card md:px-6 md:py-16 md:pb-[4.5rem]"
    >
      <div class="site-container max-w-[56.25rem] max-md:!px-0">
        <SectionTitle theme="dark">Видео</SectionTitle>
        <div
          class="relative flex aspect-video items-center justify-center rounded-player bg-dark-deep"
          role="img"
          aria-label="Видеоплеер"
        >
          <button
            type="button"
            class="flex h-14 w-14 items-center justify-center rounded-full bg-accent-light transition-transform duration-200 hover:scale-105 md:h-[4.5rem] md:w-[4.5rem]"
            aria-label="Воспроизвести"
          >
            <span
              class="ml-1.5 h-0 w-0 border-y-[0.625rem] border-l-[1.25rem] border-solid border-y-transparent border-l-dark-deep md:border-y-3 md:border-l-5"
            />
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import SectionTitle from '@/components/ui/SectionTitle.vue'
</script>
