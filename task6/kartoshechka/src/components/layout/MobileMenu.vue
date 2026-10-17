<template>
  <Teleport to="body">
    <Transition name="menu">
      <div v-if="open" class="mobile-menu" role="dialog" aria-modal="true" aria-label="Меню">
        <button
          type="button"
          class="mobile-menu__close"
          aria-label="Закрыть меню"
          @click="$emit('close')"
        >
          <span />
          <span />
        </button>

        <nav class="mobile-menu__nav">
          <a
            v-for="item in navItems"
            :key="item.id"
            :href="item.href"
            class="mobile-menu__link"
            @click.prevent="onNavClick(item.href)"
          >
            {{ item.label }}
          </a>
          <a
            :href="requestHref"
            class="mobile-menu__link"
            @click.prevent="onNavClick(requestHref)"
          >
            Оставить заявку
          </a>
        </nav>

        <div class="mobile-menu__footer">
          <p class="mobile-menu__brand">{{ brandName }}</p>
          <SocialLinks variant="menu" />
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { onMounted, onUnmounted, watch } from 'vue'
import SocialLinks from '@/components/ui/SocialLinks.vue'
import { navItems, requestHref } from '@/data/navigation'
import { brandName } from '@/data/content'
import { scrollToAnchor } from '@/composables/useAnchorNav'

const props = defineProps({
  open: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['close', 'navigate'])

let savedScrollY = 0

function lockScroll() {
  savedScrollY = window.scrollY
  document.documentElement.style.overflow = 'hidden'
  document.body.style.overflow = 'hidden'
  document.body.style.position = 'fixed'
  document.body.style.top = `-${savedScrollY}px`
  document.body.style.left = '0'
  document.body.style.right = '0'
  document.body.style.width = '100%'
}

function unlockScroll() {
  document.documentElement.style.overflow = ''
  document.body.style.overflow = ''
  document.body.style.position = ''
  document.body.style.top = ''
  document.body.style.left = ''
  document.body.style.right = ''
  document.body.style.width = ''
  window.scrollTo(0, savedScrollY)
}

function onNavClick(href) {
  scrollToAnchor(href, () => {
    emit('navigate', href)
    emit('close')
  })
}

function onKeydown(event) {
  if (event.key === 'Escape' && props.open) {
    emit('close')
  }
}

watch(
  () => props.open,
  (isOpen) => {
    if (isOpen) {
      lockScroll()
    } else {
      unlockScroll()
    }
  }
)

onMounted(() => {
  window.addEventListener('keydown', onKeydown)
  if (props.open) {
    lockScroll()
  }
})

onUnmounted(() => {
  window.removeEventListener('keydown', onKeydown)
  if (props.open) {
    unlockScroll()
  }
})
</script>
