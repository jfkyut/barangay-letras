<script setup>
defineProps({
  class: String,
  disabled: {
    type: Boolean,
    default: false
  },
  title: {
    type: String,
    default: null
  }
})

const emit = defineEmits(['click', 'mouseover', 'mouseout'])
</script>

<template>
  <li>
    <button 
      :title="title"
      :disabled="disabled"
      @click="emit('click')"
      @mouseover="emit('mouseover')"
      @mouseout="emit('mouseout')"
      :class="class"
      class="p-2 w-full items-center transition duration-75 rounded-lg group text-white hover:bg-emerald-800/50 text-start font-normal truncate disabled:opacity-50 disabled:cursor-not-allowed">
      <slot />
    </button>
  </li>
</template>