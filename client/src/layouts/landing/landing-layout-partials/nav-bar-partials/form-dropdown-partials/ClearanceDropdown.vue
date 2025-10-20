<script setup>

import DropdownButton from '@/components/dropdowns/DropdownButton.vue';
import DropdownMenu from '@/components/dropdowns/DropdownMenu.vue';
import DropdownLink from '@/components/dropdowns/DropdownLink.vue';
import { ref } from 'vue';

const isShowDropdown = ref(false);

</script>

<template>
    <dropdown-button class="flex justify-between items-center relative"
        @mouseover="isShowDropdown = true"
        @mouseout="isShowDropdown = false"
    >
        Clearances
        <i class="ri-arrow-right-s-line"></i>

        <dropdown-menu
            :show="isShowDropdown"
            @mouseover="isShowDropdown = true"
            @mouseout="isShowDropdown = false"
            position="top-0 left-full ml-1"
        >
            <dropdown-button>
                Clearance 1
            </dropdown-button>
            <dropdown-button>
                Clearance 2
            </dropdown-button>
            <dropdown-button>
                Clearance 3
            </dropdown-button>
        </dropdown-menu>
    </dropdown-button>
</template>