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
    class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">
    <slot/>
  </button>
</template>