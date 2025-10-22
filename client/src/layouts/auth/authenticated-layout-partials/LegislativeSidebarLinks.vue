<script setup>

import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import { ref, watch } from 'vue';

const isShowDropdown = ref(
    JSON.parse(sessionStorage.getItem('legislative-sidebar-links-dropdown'))
    || false
)

watch(isShowDropdown, (isShowDropdown) => {
    sessionStorage.setItem('legislative-sidebar-links-dropdown', JSON.stringify(isShowDropdown));
})

</script>

<template>
    <NavDropdownTrigger
        button-text="Legislatives"
        icon-class="ri-auction-fill"
        @toggle-dropdown="isShowDropdown = !isShowDropdown"
        :is-links-show="isShowDropdown"
    >
        <NavDropdownButton>
            Sessions
        </NavDropdownButton>
        <NavDropdownButton>
            Committees
        </NavDropdownButton>
    </NavDropdownTrigger>
</template>