<template>
  <h2
    class="relative mb-8 pb-4 text-center text-[1.75rem] font-bold md:mb-12 md:text-4xl"
    :class="theme === 'dark' ? 'text-white' : 'text-text'"
  >
    <slot />
    <span
      class="absolute bottom-0 left-1/2 h-1 w-12 -translate-x-1/2 rounded-sm bg-accent-light"
      aria-hidden="true"
    />
  </h2>
</template>

<script setup>
defineProps({
  theme: {
    type: String,
    default: 'light',
    validator: (v) => ['light', 'dark'].includes(v),
  },
})
</script>
