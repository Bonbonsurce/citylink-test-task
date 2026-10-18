<template>
  <section
    id="request"
    class="relative z-[3] -mt-10 px-0 max-md:-mt-10 md:-mt-[clamp(3.5rem,8vw,5.25rem)] md:px-6"
  >
    <div
      class="relative z-[3] mx-auto flex min-h-[20rem] max-w-[43.75rem] flex-col justify-center rounded-none bg-dark px-6 py-10 text-white max-md:max-w-none md:max-w-[52.5rem] md:rounded-card md:px-14 md:py-[3.25rem]"
    >
      <h2 class="mb-8 text-center text-[1.75rem] font-bold">Оставить заявку</h2>

      <p v-if="submitted" class="m-0 text-center text-base leading-relaxed text-white/90">
        Спасибо, что оставили заявку! Скоро свяжемся с вами.
      </p>

      <form v-else class="flex flex-col gap-5" @submit.prevent="onSubmit">
        <label class="flex flex-col gap-1.5">
          <span class="visually-hidden">Имя</span>
          <input
            v-model="name"
            type="text"
            name="name"
            placeholder="Имя"
            autocomplete="name"
            required
            class="w-full rounded-lg border border-white/35 bg-transparent px-4 py-3.5 font-[inherit] text-[0.9375rem] text-white outline-none placeholder:text-white/45 focus:border-accent-light"
          />
        </label>
        <label class="flex flex-col gap-1.5">
          <span class="text-xs text-white/50">Номер телефона</span>
          <input
            v-model="phone"
            type="tel"
            name="phone"
            placeholder="+7 905 299 44 55"
            autocomplete="tel"
            required
            class="w-full rounded-lg border border-white/35 bg-transparent px-4 py-3.5 font-[inherit] text-[0.9375rem] text-white outline-none placeholder:text-white/45 focus:border-accent-light"
          />
        </label>
        <AppButton variant="filled" type="submit" block>
          Оставить заявку
        </AppButton>
      </form>
    </div>
  </section>
</template>

<script setup>
import { onUnmounted, ref } from 'vue'
import AppButton from '@/components/ui/AppButton.vue'

const name = ref('')
const phone = ref('')
const submitted = ref(false)
let resetTimer = null

function onSubmit() {
  submitted.value = true
  name.value = ''
  phone.value = ''

  if (resetTimer) {
    clearTimeout(resetTimer)
  }

  resetTimer = setTimeout(() => {
    submitted.value = false
    resetTimer = null
  }, 3000)
}

onUnmounted(() => {
  if (resetTimer) {
    clearTimeout(resetTimer)
  }
})
</script>
