<template>
  <component
    :is="tag"
    :type="tag === 'button' ? type : undefined"
    :href="tag === 'a' ? href : undefined"
    class="app-button"
    :class="[`app-button--${variant}`, { 'app-button--block': block }]"
    @click="onClick"
  >
    <slot />
  </component>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  variant: {
    type: String,
    default: 'outline',
    validator: (v) => ['outline', 'filled'].includes(v),
  },
  href: {
    type: String,
    default: '',
  },
  type: {
    type: String,
    default: 'button',
  },
  block: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['click'])

const tag = computed(() => (props.href ? 'a' : 'button'))

function onClick(event) {
  emit('click', event)
}
</script>
