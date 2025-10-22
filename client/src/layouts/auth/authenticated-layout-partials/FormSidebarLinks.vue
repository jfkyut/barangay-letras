<script setup>

import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import ClearanceLinks from './form-sidebar-links-partials/ClearanceLinks.vue';
import { ref, watch } from 'vue';
import CertificationLinks from './form-sidebar-links-partials/CertificationLinks.vue';

const isShowDropdown = ref(
    sessionStorage.getItem('form-sidebar-links-dropdown') 
    || false
);

watch(isShowDropdown, (isShowDropdown) => {
    sessionStorage.setItem('form-sidebar-links-dropdown', JSON.stringify(isShowDropdown));
})

</script>

<template>
    <NavDropdownTrigger
        @toggle-dropdown="isShowDropdown = !isShowDropdown"
        button-text="Forms"
        icon-class="ri-file-info-fill"
        :is-links-show="isShowDropdown"
    >
        <ClearanceLinks />
        <CertificationLinks />
    </NavDropdownTrigger>
</template>