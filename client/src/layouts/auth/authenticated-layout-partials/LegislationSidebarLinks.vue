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
  sessionStorage.getItem('legislation-sidebar-links-dropdown') === 'true' ||
  false
);

watch(isShowDropdown, (isShowDropdown) => {
  sessionStorage.setItem('legislation-sidebar-links-dropdown', isShowDropdown.toString());
})

</script>

<template>
  <NavDropdownTrigger
    buttonText="Legislations"
    iconClass="ri-file-list-3-fill"
    :isLinksShow="isShowDropdown"
    activeRoute="legislation"
    @toggle-dropdown="isShowDropdown = !isShowDropdown"
  >
    <NavDropdownLink 
      @click="closeOnSmallScreen()"
      to="/resolutions"
    >
      Resolutions
    </NavDropdownLink>
    <NavDropdownLink 
      @click="closeOnSmallScreen()"
      to="/ordinances"
    >
      Ordinances
    </NavDropdownLink>
    <NavDropdownLink 
      @click="closeOnSmallScreen()"
      to="/appropriation-ordinances"
    >
      Appropriations
    </NavDropdownLink>
  </NavDropdownTrigger>
</template>