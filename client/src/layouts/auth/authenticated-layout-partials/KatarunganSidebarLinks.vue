<script setup>

import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import { ref, watch } from 'vue';

const isShowDropdown = ref(
    JSON.parse(sessionStorage.getItem('katarungan-sidebar-links-dropdown'))
    || false
)

watch(isShowDropdown, (isShowDropdown) => {
    sessionStorage.setItem('katarungan-sidebar-links-dropdown', JSON.stringify(isShowDropdown));
})

</script>

<template>
    <NavDropdownTrigger
        button-text="Katarungang Pambaranggay"
        icon-class="ri-scales-3-line"
        @toggle-dropdown="isShowDropdown = !isShowDropdown"
        :is-links-show="isShowDropdown"
        active-route="katarungan"
    >
        <NavDropdownLink title="Punong Barangay Mediation" to="/punong-barangay-mediation">
            Punong Barangay Mediation
        </NavDropdownLink>
        <NavDropdownLink title="Lupong Tagapamayapa" to="/lupong-tagapamayapa">
            Lupong Tagapamayapa
        </NavDropdownLink>
    </NavDropdownTrigger>
</template>