<template>
  <section id="about" class="about">
    <div class="about__desktop">
      <div class="container">
        <SectionTitle>О нас</SectionTitle>

        <div class="about__layout">
          <img
            :src="potatoLeft"
            alt=""
            class="about__potato about__potato--left"
            aria-hidden="true"
          />

          <div class="about__chef-col">
            <img :src="chefImg" alt="Повар" class="about__chef" />
          </div>

          <div class="about__text">
            <p v-for="(paragraph, index) in aboutParagraphs" :key="index">
              {{ paragraph }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="about__mobile">
      <div class="about__mobile-bg" aria-hidden="true">
        <img :src="chefImg" alt="" class="about__mobile-chef" />
      </div>
      <div class="about__mobile-overlay" aria-hidden="true" />
      <div class="container about__mobile-content">
        <SectionTitle>О нас</SectionTitle>
        <div class="about__text about__text--mobile">
          <p v-for="(paragraph, index) in aboutParagraphs" :key="index">
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
