<script setup>
import { useThemeStore } from '@/stores/theme';
import { storeToRefs } from 'pinia';

const { theme } = storeToRefs(useThemeStore());
const { setToDark, setToLight } = useThemeStore();

const toggleTheme = (e) => {
  e.target.checked
    ? setToDark()
    : setToLight()
}
</script>

<template>
  <div class="flex items-center justify-between p-2 rounded-lg text-white hover:bg-emerald-800/50 group font-normal">
    <div>
      <span class="w-5 h-5 transition duration-75 text-emerald-400 group-hover:text-white">
          <i class="ri-moon-fill"></i>
        </span>
      <span class="ms-3">Dark mode</span>
    </div>

    <label class="inline-flex items-center cursor-pointer">
      <input 
        type="checkbox" 
        class="sr-only peer" 
        :checked="theme === 'dark' ? true : false"
        @change="toggleTheme">
      <div 
        class="relative w-11 h-6 bg-zinc-200 rounded-full peer 
               peer-focus:ring-4 peer-focus:ring-emerald-300 
               dark:peer-focus:ring-emerald-800 dark:bg-zinc-700 
               peer-checked:after:translate-x-full 
               rtl:peer-checked:after:-translate-x-full 
               peer-checked:after:border-white after:content-[''] 
               after:absolute after:top-0.5 after:start-[2px] 
               after:bg-white after:border-zinc-300 after:border 
               after:rounded-full after:h-5 after:w-5 
               after:transition-all dark:border-zinc-600 
               peer-checked:bg-emerald-600">
      </div>
    </label>
  </div>
</template>