<script setup>

defineProps({ 
  type: {
    type: String,
    default: 'text'
  },  
  name: String, 
  placeholder: String,
  required: {
    type: Boolean,
    default: false
  },
  class: {
    type: String,
    default: ''
  },
  readOnly: {
    type: Boolean,
    default: false
  },
  modelValue: String || Number
})

const emit = defineEmits(['update:modelValue'])

const handleChange = (e) => {
  emit('update:modelValue', e.target.value);
};

</script>

<template>
  <input 
    :readonly="readOnly"
    :type="type" 
    :id="name"
    :name="name" 
    :class="class"
    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-emerald-500 focus:ring-4 focus:outline-none focus:border-emerald-500 block w-full p-2.5 dark:bg-zinc-600 dark:border-zinc-500 dark:placeholder-zinc-400 dark:text-white" 
    :placeholder="placeholder" 
    :required="required"
    @input="handleChange"
    :value="modelValue" />
</template>