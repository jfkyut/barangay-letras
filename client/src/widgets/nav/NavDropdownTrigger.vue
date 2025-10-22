<script setup>

import { useRoute } from 'vue-router';

const emit = defineEmits(['toggle-dropdown']);

defineProps({ 
  buttonText: String, 
  iconClass: String, 
  isLinksShow: Boolean,
  activeRoute: String
})

const route = useRoute();

</script>

<template>
  <button 
    :title="buttonText"
    @click="emit('toggle-dropdown')" 
    :class="route.name.includes(activeRoute) && 'bg-zinc-700'"
    class="flex items-center p-2 rounded-lg text-white hover:bg-zinc-700 group w-full font-normal">
    <div class="flex justify-between items-end w-full">
      <div class="truncate">
        <span class="w-5 h-5 transition duration-75 text-zinc-400 group-hover:text-white">
          <i :class="iconClass"></i>
        </span>
        <span class="ms-3">{{ buttonText }}</span>
      </div>
      <div>
        <span>
          <i v-if="isLinksShow" class="ri-arrow-up-s-line"></i>
          <i v-else class="ri-arrow-down-s-line"></i>
        </span>
      </div>
    </div>
  </button>
  <ul 
    id="dropdown-example" 
    v-show="isLinksShow"
    class="p-2 space-y-2 duration-200 max-h-[30vh] overflow-y-auto bg-zinc-800 z-[1000] border-l border-zinc-600 ml-6">
    <slot/>
  </ul>
</template>