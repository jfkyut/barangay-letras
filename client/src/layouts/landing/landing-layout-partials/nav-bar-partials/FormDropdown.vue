<script setup>

import DropdownMenu from '@/components/dropdowns/DropdownMenu.vue';
import DropdownButton from '@/components/dropdowns/DropdownButton.vue';
import DropdownLink from '@/components/dropdowns/DropdownLink.vue';
import { ref } from 'vue';
import ClearanceDropdown from './form-dropdown-partials/ClearanceDropdown.vue';
import CertificationDropdown from './form-dropdown-partials/CertificationDropdown.vue';

const isShowModal = ref(false);

</script>

<template>
    <button
        @mouseover="isShowModal = true"
        @mouseout="isShowModal = false" 
        class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white relative"
    >
        Forms
        <i v-if="isShowModal" class="ri-arrow-up-s-line"></i>
        <i v-else class="ri-arrow-down-s-line"></i>

        <dropdown-menu
            position="top-12"
            :show="isShowModal"
            @mouseover="isShowModal = true"
            @mouseout="isShowModal = false"
        >
            <ClearanceDropdown />
            <CertificationDropdown />
        </dropdown-menu>
    </button>
</template>