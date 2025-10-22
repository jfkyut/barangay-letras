<script setup>

import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import { ref, watch } from 'vue';

const isShowDropdown = ref(
    JSON.parse(sessionStorage.getItem('certification-sidebar-links-dropdown'))
    || false
)

watch(isShowDropdown, (isShowDropdown) => {
    sessionStorage.setItem('certification-sidebar-links-dropdown', JSON.stringify(isShowDropdown));
})

</script>

<template>
    <NavDropdownTrigger
        button-text="Certifications"
        icon-class="ri-file-info-line"
        @toggle-dropdown="isShowDropdown = !isShowDropdown"
        :is-links-show="isShowDropdown"
    >
        <NavDropdownButton>
            certification 1
        </NavDropdownButton>
        <NavDropdownButton>
            certification 1
        </NavDropdownButton>
        <NavDropdownButton>
            certification 1
        </NavDropdownButton>
    </NavDropdownTrigger>
</template>