<script setup>

import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import { useSidebarStore } from '@/stores/sidebar';
import { storeToRefs } from 'pinia';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import { ref, watch } from 'vue';

const { setHide } = useSidebarStore();

const closeOnSmallScreen = () => {
  if (window.innerWidth <= 768) setHide()
}

const isShowDropdown = ref(
  JSON.parse(sessionStorage.getItem('issuance-sidebar-links-dropdown')) ||
  false
);

watch(isShowDropdown, (isShowDropdown) => {
  sessionStorage.setItem('issuance-sidebar-links-dropdown', JSON.stringify(isShowDropdown));
})

</script>

<template>
  <NavDropdownTrigger
    buttonText="Issuances"
    iconClass="ri-file-list-3-fill"
    :isLinksShow="isShowDropdown"
    activeRoute="issuance"
    @toggle-dropdown="isShowDropdown = !isShowDropdown"
  >
    <NavDropdownButton>
        Executive Order
    </NavDropdownButton>
    <NavDropdownButton>
        Memorandum
    </NavDropdownButton>
    <NavDropdownButton>
        Office Order
    </NavDropdownButton>
  </NavDropdownTrigger>
</template>