<template>
  <section id="prices" class="prices">
    <div class="container prices__inner">
      <SectionTitle class="prices__title">Цены</SectionTitle>

      <div
        class="prices__carousel"
        @touchstart.passive="onTouchStart"
        @touchend="onTouchEnd"
      >
        <button
          type="button"
          class="prices__arrow prices__arrow--prev"
          aria-label="Предыдущий товар"
          @click="prev"
        >
          ‹
        </button>

        <div class="prices__slide">
          <div class="prices__image-box">
            <img
              :src="currentProduct.image"
              :alt="currentProduct.name"
              class="prices__image"
            />
          </div>
          <p class="prices__name">{{ currentProduct.name }}</p>
          <p class="prices__price">{{ currentProduct.price }}</p>
        </div>

        <button
          type="button"
          class="prices__arrow prices__arrow--next"
          aria-label="Следующий товар"
          @click="next"
        >
          ›
        </button>
      </div>

      <div class="prices__dots" role="tablist" aria-label="Выбор товара">
        <button
          v-for="(product, index) in products"
          :key="product.id"
          type="button"
          class="prices__dot"
          :class="{ 'prices__dot--active': index === currentIndex }"
          :aria-label="product.name"
          :aria-selected="index === currentIndex"
          @click="goTo(index)"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, ref } from 'vue'
import SectionTitle from '@/components/ui/SectionTitle.vue'
import { products } from '@/data/products'

const currentIndex = ref(0)
let touchStartX = 0

const currentProduct = computed(() => products[currentIndex.value])

function prev() {
  currentIndex.value =
    (currentIndex.value - 1 + products.length) % products.length
}

function next() {
  currentIndex.value = (currentIndex.value + 1) % products.length
}

function goTo(index) {
  currentIndex.value = index
}

function onTouchStart(event) {
  touchStartX = event.changedTouches[0].screenX
}

function onTouchEnd(event) {
  const delta = event.changedTouches[0].screenX - touchStartX
  if (Math.abs(delta) < 40) return
  if (delta > 0) prev()
  else next()
}
</script>
