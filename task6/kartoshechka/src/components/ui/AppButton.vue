<template>
  <component
    :is="tag"
    :type="tag === 'button' ? type : undefined"
    :href="tag === 'a' ? href : undefined"
    class="inline-flex items-center justify-center whitespace-nowrap rounded-full text-sm font-medium transition-colors duration-200"
    :class="buttonClasses"
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

const buttonClasses = computed(() => {
  const classes = [props.block ? 'w-full' : '']

  if (props.variant === 'filled') {
    classes.push(
      'border-0 bg-accent-light px-8 py-3.5 font-semibold text-dark hover:bg-accent-filled-hover'
    )
  } else {
    classes.push(
      'border border-white bg-transparent px-7 py-3 text-white hover:border-white hover:bg-white hover:text-text'
    )
  }

  return classes
})

function onClick(event) {
  emit('click', event)
}
</script>
