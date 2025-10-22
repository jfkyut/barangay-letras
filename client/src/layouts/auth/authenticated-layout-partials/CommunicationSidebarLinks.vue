<script setup>

import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import { ref, watch } from 'vue';

const isShowDropdown = ref(
    JSON.parse(sessionStorage.getItem('communication-sidebar-links-dropdown'))
    || false
)

watch(isShowDropdown, (isShowDropdown) => {
    sessionStorage.setItem('communication-sidebar-links-dropdown', JSON.stringify(isShowDropdown));
})

</script>

<template>
    <NavDropdownTrigger
        button-text="Communications"
        icon-class="ri-signal-tower-line"
        @toggle-dropdown="isShowDropdown = !isShowDropdown"
        :is-links-show="isShowDropdown"
        active-route="communication"
    >
        <NavDropdownLink to="/incoming-communications">
            Incoming Communications
        </NavDropdownLink>
        <NavDropdownLink to="/outgoing-communications">
            Outgoing Communications
        </NavDropdownLink>
    </NavDropdownTrigger>
</template>