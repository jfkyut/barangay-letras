<script setup>
defineProps({
  type: {
    type: String,
    default: 'button'
  },
  disabled: {
    type: Boolean, 
    default: false
  }
})

</script>

<template>
  <button 
    :disabled="disabled"
    :type="type" 
    class="inline-flex items-center p-2 text-sm text-zinc-500 rounded-lg hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:focus:ring-zinc-600">
    <slot/>
  </button>
</template>