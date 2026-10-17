<template>
  <section id="video" class="video-section">
    <div class="video-section__wrap">
      <div class="container video-section__inner">
        <SectionTitle theme="dark">Видео</SectionTitle>
        <div class="video-section__player" role="img" aria-label="Видеоплеер">
          <button type="button" class="video-section__play" aria-label="Воспроизвести">
            <span class="video-section__play-icon" />
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import SectionTitle from '@/components/ui/SectionTitle.vue'
</script>
