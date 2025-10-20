<script setup>

import DropdownMenu from '@/components/dropdowns/DropdownMenu.vue';
import DropdownLink from '@/components/dropdowns/DropdownLink.vue';
import DropdownButton from '@/components/dropdowns/DropdownButton.vue';
import { ref } from 'vue';

const isShowDropdown = ref(false);

</script>

<template>
  <button 
    @mouseover="isShowDropdown = true"
    @mouseout="isShowDropdown = false"
    class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white relative"
  >
    Legislations
    <i class="ri-arrow-down-s-line"></i>

    <dropdown-menu
      :show="isShowDropdown"
      @mouseover="isShowDropdown = true"
      @mouseout="isShowDropdown = false"
      position="top-12"
    >
      <dropdown-button>
        Resolutions
      </dropdown-button>
      <dropdown-button>
        Ordinances
      </dropdown-button>
      <dropdown-button>
        Appropriations
      </dropdown-button>
    </dropdown-menu>
  </button>
</template>