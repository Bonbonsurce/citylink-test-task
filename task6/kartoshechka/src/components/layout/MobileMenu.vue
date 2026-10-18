<template>
  <Teleport to="body">
    <Transition name="menu">
      <div
        v-if="open"
        class="fixed inset-0 z-[200] flex flex-col overflow-hidden overscroll-none bg-white px-4 pb-10 pt-6"
        role="dialog"
        aria-modal="true"
        aria-label="Меню"
      >
        <button
          type="button"
          class="relative mb-12 ml-auto h-8 w-8"
          aria-label="Закрыть меню"
          @click="$emit('close')"
        >
          <span
            class="absolute left-1/2 top-1/2 block h-0.5 w-6 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-text"
          />
          <span
            class="absolute left-1/2 top-1/2 block h-0.5 w-6 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-text"
          />
        </button>

        <nav class="flex flex-1 flex-col items-start justify-start gap-9 pl-10 pr-6 pt-2">
          <a
            v-for="item in navItems"
            :key="item.id"
            :href="item.href"
            class="text-2xl font-medium text-text"
            @click.prevent="onNavClick(item.href)"
          >
            {{ item.label }}
          </a>
          <a
            :href="requestHref"
            class="text-2xl font-medium text-text"
            @click.prevent="onNavClick(requestHref)"
          >
            Оставить заявку
          </a>
        </nav>

        <div class="text-center">
          <p class="mb-5 text-[1.375rem] font-extrabold tracking-wide">{{ brandName }}</p>
          <SocialLinks variant="menu" />
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { nextTick, onMounted, onUnmounted, watch } from 'vue'
import SocialLinks from '@/components/ui/SocialLinks.vue'
import { navItems, requestHref } from '@/data/navigation'
import { brandName } from '@/data/content'

const props = defineProps({
  open: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['close', 'navigate'])

let savedScrollY = 0
let scrollTargetAfterClose = null

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
  scrollTargetAfterClose = href
  emit('navigate', href)
  emit('close')
}

function scrollToSection(href) {
  const id = href.replace('#', '')
  const el = document.getElementById(id)
  if (!el) return

  const offset = 96
  const top = el.getBoundingClientRect().top + window.scrollY - offset
  window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' })
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
      return
    }

    unlockScroll()

    const href = scrollTargetAfterClose
    scrollTargetAfterClose = null
    if (!href) return

    nextTick(() => {
      scrollToSection(href)
    })
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
