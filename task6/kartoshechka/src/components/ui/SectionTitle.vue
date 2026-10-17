<template>
  <h2 class="section-title" :class="[`section-title--${theme}`]">
    <slot />
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
