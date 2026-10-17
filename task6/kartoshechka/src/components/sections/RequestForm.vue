<template>
  <section id="request" class="request">
    <div class="request__card">
      <h2 class="request__title">Оставить заявку</h2>

      <p v-if="submitted" class="request__thanks">
        Спасибо, что оставили заявку! Скоро свяжемся с вами.
      </p>

      <form v-else class="request__form" @submit.prevent="onSubmit">
        <label class="request__field">
          <span class="visually-hidden">Имя</span>
          <input
            v-model="name"
            type="text"
            name="name"
            placeholder="Имя"
            autocomplete="name"
            required
          />
        </label>
        <label class="request__field">
          <span class="request__label">Номер телефона</span>
          <input
            v-model="phone"
            type="tel"
            name="phone"
            placeholder="+7 905 299 44 55"
            autocomplete="tel"
            required
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
