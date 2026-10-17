<template>
  <header class="app-header" :class="{ 'app-header--solid': solid }">
    <div class="app-header__inner container">
      <AppLogo />

      <nav class="app-header__nav" aria-label="Основная навигация">
        <a
          v-for="item in navItems"
          :key="item.id"
          :href="item.href"
          class="app-header__link"
          :class="{ 'app-header__link--active': activeSection === item.id }"
          @click.prevent="onNavClick(item.href)"
        >
          {{ item.label }}
        </a>
      </nav>

      <AppButton
        class="app-header__cta app-header__cta--desktop"
        variant="outline"
        :href="requestHref"
        @click.prevent="onNavClick(requestHref)"
      >
        Оставить заявку
      </AppButton>

      <button
        type="button"
        class="app-header__burger"
        aria-label="Открыть меню"
        @click="$emit('toggle-menu')"
      >
        <span />
        <span />
        <span />
      </button>
    </div>
  </header>
</template>

<script setup>
import AppLogo from '@/components/ui/AppLogo.vue'
import AppButton from '@/components/ui/AppButton.vue'
import { navItems, requestHref } from '@/data/navigation'
import { scrollToAnchor } from '@/composables/useAnchorNav'

defineProps({
  activeSection: {
    type: String,
    default: '',
  },
  solid: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['toggle-menu', 'navigate'])

function onNavClick(href) {
  scrollToAnchor(href, () => emit('navigate', href))
}
</script>