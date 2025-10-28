<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router';
import FormDropdown from './nav-bar-partials/FormDropdown.vue';
import LegislationDropdown from './nav-bar-partials/LegislationDropdown.vue';
import LegislativeDropdown from './nav-bar-partials/LegislativeDropdown.vue';
import CommunicationDropdown from './nav-bar-partials/CommunicationDropdown.vue';
import KatarunganDropdown from './nav-bar-partials/KatarunganDropdown.vue';
import { Button } from 'primevue';
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router';

const route = useRoute();

const appName = import.meta.env.VITE_APP_NAME;

const open = ref(false)

</script>

<template>
  <nav class="bg-white shadow dark:bg-zinc-800 dark:shadow-sm border-b dark:border-zinc-700">
    <div class="lg:max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex flex-col justify-center">
          <h1>
            <a class="text-xl font-semibold text-emerald-600 dark:text-emerald-400" href="#">
              {{ appName }}
            </a>
          </h1>
        </div>

        <!-- nav and dropdown -->
        <div class="hidden sm:flex sm:items-center sm:space-x-6">
          <router-link to="/" class="text-zinc-600 hover:text-zinc-800 dark:text-zinc-300 dark:hover:text-white">Home</router-link>
          <router-link to="#about" class="text-zinc-600 hover:text-zinc-800 dark:text-zinc-300 dark:hover:text-white">About</router-link>
          <FormDropdown />
          
          <LegislationDropdown />
          
          <LegislativeDropdown />
          
          <CommunicationDropdown />
          
          <KatarunganDropdown />

          <button class="text-zinc-600 hover:text-zinc-800 dark:text-zinc-300 dark:hover:text-white relative">
            VAWC
          </button>

          <button class="text-zinc-600 hover:text-zinc-800 dark:text-zinc-300 dark:hover:text-white relative">
            Local Special Bodies
            <i class="ri-arrow-down-s-line"></i>
          </button>

          <Button @click="$router.push('login')">
            Login
          </Button>
        </div>
        <!-- nav and dropdown end -->

        <!-- Mobile menu button -->
        <div class="flex items-center sm:hidden">
          <button @click="open = !open" class="p-2 rounded-md text-zinc-600 hover:bg-zinc-100 focus:outline-none dark:text-zinc-300 dark:hover:bg-zinc-800">
            <svg v-if="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div v-show="open" class="sm:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t dark:bg-zinc-800 dark:border-zinc-700">
        <a class="block px-3 py-2 rounded-md text-base font-medium text-zinc-700 hover:bg-zinc-50 dark:text-zinc-200 dark:hover:bg-zinc-800" href="#features">Features</a>
        <a class="block px-3 py-2 rounded-md text-base font-medium text-zinc-700 hover:bg-zinc-50 dark:text-zinc-200 dark:hover:bg-zinc-800" href="#pricing">Pricing</a>
        <a class="block px-3 py-2 rounded-md text-base font-medium text-zinc-700 hover:bg-zinc-50 dark:text-zinc-200 dark:hover:bg-zinc-800" href="#contact">Contact</a>
        <a class="block px-3 py-2 rounded-md text-base font-medium text-white bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600" href="#get-started">Get started</a>
      </div>
    </div>
  </nav>
</template>