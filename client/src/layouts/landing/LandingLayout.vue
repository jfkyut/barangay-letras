<script setup>

import NavBar from './landing-layout-partials/NavBar.vue';
import Footer from './landing-layout-partials/Footer.vue';

</script>

<template>
  <div class="min-h-screen flex flex-col">

    <NavBar />

    <main class="flex-grow text-gray-800 dark:text-gray-300">
        <slot />
    </main>

    <Footer />
  </div>
</template>
