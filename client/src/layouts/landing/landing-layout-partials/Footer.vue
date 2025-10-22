<script setup>
const year = new Date().getFullYear()
</script>

<template>
  <footer class="bg-zinc-50 border-t dark:bg-zinc-800 dark:border-zinc-700">
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center justify-center">
        <div class="text-sm text-zinc-600 dark:text-zinc-300">&copy; {{ year }} LETRAS B</div>
      </div>
    </div>
  </footer>
</template>