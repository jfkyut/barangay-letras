<script setup>

import NavBar from './landing-layout-partials/NavBar.vue';
import Footer from './landing-layout-partials/Footer.vue';

</script>

<template>
  <div class="min-h-screen flex flex-col">

    <NavBar />

    <main class="flex-grow text-zinc-800 dark:text-zinc-300 lg:max-w-[90%] w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <slot />
    </main>

    <Footer />
  </div>
</template>
