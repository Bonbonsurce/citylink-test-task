<template>
  <section id="prices" class="bg-white py-16 md:py-20">
    <div class="site-container text-center">
      <SectionTitle class="!text-[2rem] !font-extrabold max-md:!text-[2rem] md:!text-[2.5rem]">
        Цены
      </SectionTitle>

      <div
        class="mx-auto flex max-w-[40rem] items-center justify-center gap-4 md:gap-6"
        @touchstart.passive="onTouchStart"
        @touchend="onTouchEnd"
      >
        <button
          type="button"
          class="flex h-20 w-20 shrink-0 items-center justify-center text-[5rem] font-light leading-none text-accent-hover md:h-24 md:w-24 md:text-[6rem]"
          aria-label="Предыдущий товар"
          @click="prev"
        >
          ‹
        </button>

        <div class="min-w-0 flex-1">
          <div
            class="mx-auto mb-6 flex h-[17.5rem] max-w-[20rem] items-center justify-center md:h-[20rem]"
          >
            <img
              :src="currentProduct.image"
              :alt="currentProduct.name"
              class="h-auto max-h-full w-auto max-w-full object-contain"
            />
          </div>
          <p class="mb-2 text-lg font-medium text-text">{{ currentProduct.name }}</p>
          <p class="m-0 text-4xl font-light text-accent md:text-[2.625rem]">{{ currentProduct.price }}</p>
        </div>

        <button
          type="button"
          class="flex h-20 w-20 shrink-0 items-center justify-center text-[5rem] font-light leading-none text-accent-hover md:h-24 md:w-24 md:text-[6rem]"
          aria-label="Следующий товар"
          @click="next"
        >
          ›
        </button>
      </div>

      <div class="mt-6 flex justify-center gap-2.5 md:hidden" role="tablist" aria-label="Выбор товара">
        <button
          v-for="(product, index) in products"
          :key="product.id"
          type="button"
          class="h-2.5 w-2.5 rounded-full p-0 transition-colors duration-200"
          :class="index === currentIndex ? 'bg-accent-hover' : 'bg-[#d0d0d0]'"
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
