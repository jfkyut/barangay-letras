<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router';
const open = ref(false)

</script>

<template>
  <nav class="bg-white shadow dark:bg-gray-800 dark:shadow-sm border-b dark:border-gray-700">
    <div class="lg:max-w-[90%] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <a class="text-xl font-semibold text-indigo-600 dark:text-indigo-400" href="#">LETRAS B</a>
        </div>
        <div class="hidden sm:flex sm:items-center sm:space-x-6">
          <router-link to="/" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Home</router-link>
          <router-link to="#about" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">About</router-link>
          <button class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
            Forms
            <i class="ri-arrow-down-s-line"></i>
          </button>
          <router-link to="#legislatives" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Legislatives</router-link>
          <router-link to="#forms" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Legislations</router-link>
          <router-link to="#comms" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Communications</router-link>
          <router-link to="#katarungan" class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Katarungang Pambarangay</router-link>

          <RouterLink to="login" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">
            Login
          </RouterLink>
        </div>

        <!-- Mobile menu button -->
        <div class="flex items-center sm:hidden">
          <button @click="open = !open" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800">
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
      <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t dark:bg-gray-800 dark:border-gray-700">
        <a class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-800" href="#features">Features</a>
        <a class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-800" href="#pricing">Pricing</a>
        <a class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-800" href="#contact">Contact</a>
        <a class="block px-3 py-2 rounded-md text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600" href="#get-started">Get started</a>
      </div>
    </div>
  </nav>
</template>