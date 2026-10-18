<template>
  <section id="about" class="relative bg-white">
    <div class="hidden md:block md:pt-16">
      <div class="site-container">
        <SectionTitle>О нас</SectionTitle>

        <div
          class="relative mx-auto flex max-w-about flex-col items-stretch gap-6 pl-0 pr-0 md:flex-row md:items-end md:gap-[clamp(1.5rem,4vw,3rem)] md:pr-[clamp(1rem,3vw,2rem)] min-[59.375rem]:pl-[clamp(2.5rem,6vw,4.5rem)] xl:max-w-about-wide"
        >
          <img
            :src="potatoLeft"
            alt=""
            class="about-potato-left"
            aria-hidden="true"
          />

          <div
            class="relative z-[2] flex w-full shrink-0 items-end justify-end md:w-[clamp(17.5rem,32vw,23.75rem)] md:max-w-[23.75rem]"
          >
            <img
              :src="chefImg"
              alt="Повар"
              class="about-chef-img"
            />
          </div>

          <div
            class="relative z-[2] min-w-0 flex-1 self-start pb-[clamp(4rem,10vw,5.5rem)] md:max-w-[23.125rem]"
          >
            <p
              v-for="(paragraph, index) in aboutParagraphs"
              :key="index"
              class="mb-5 text-base leading-relaxed text-text-muted last:mb-0"
            >
              {{ paragraph }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="relative min-h-[85vh] w-full overflow-hidden md:hidden">
      <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
        <img
          :src="chefImg"
          alt=""
          class="h-full w-full object-cover object-top blur-[2.5px]"
        />
      </div>
      <div
        class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/70 to-white/85"
        aria-hidden="true"
      />
      <div class="site-container relative z-[2] py-12 pb-14">
        <SectionTitle>О нас</SectionTitle>
        <div class="mx-auto max-w-[18.75rem] text-center">
          <p
            v-for="(paragraph, index) in aboutParagraphs"
            :key="index"
            class="mb-5 text-[0.9375rem] leading-relaxed text-text last:mb-0"
          >
            {{ paragraph }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import SectionTitle from '@/components/ui/SectionTitle.vue'
import chefImg from '@/assets/povar.png'
import potatoLeft from '@/assets/potato-left.png'
import { aboutParagraphs } from '@/data/content'
</script>
