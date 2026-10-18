<template>
  <header class="absolute inset-x-0 top-0 z-[100] py-4 md:py-5">
    <div class="site-container flex items-center gap-6">
      <AppLogo />

      <nav class="ml-auto hidden items-center gap-10 md:flex" aria-label="Основная навигация">
        <a
          v-for="item in navItems"
          :key="item.id"
          :href="item.href"
          class="nav-link-underline"
          :class="{ 'nav-link-underline--active': activeSection === item.id }"
          @click.prevent="onNavClick(item.href)"
        >
          {{ item.label }}
        </a>
      </nav>

      <AppButton
        class="ml-2 hidden md:inline-flex"
        variant="outline"
        :href="requestHref"
        @click.prevent="onNavClick(requestHref)"
      >
        Оставить заявку
      </AppButton>

      <button
        type="button"
        class="ml-auto flex h-[3.5625rem] w-11 flex-col justify-center gap-[0.4375rem] md:hidden"
        aria-label="Открыть меню"
        @click="$emit('toggle-menu')"
      >
        <span class="block h-[0.1875rem] w-[1.875rem] bg-white" />
        <span class="block h-[0.1875rem] w-[1.875rem] bg-white" />
        <span class="block h-[0.1875rem] w-[1.875rem] bg-white" />
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
