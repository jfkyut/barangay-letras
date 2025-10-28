<script setup>
import { useSidebarStore } from '@/stores/sidebar';
import UserDropdown from '@/layouts/auth/partials/UserDropdown.vue';
import ExtraButton from '@/components/buttons/ExtraButton.vue';
import { storeToRefs } from 'pinia';
import ThemeToggler from '@/layouts/auth/partials/ThemeToggler.vue';
import { useRoute } from 'vue-router';
import { useAuthPageTitleStore } from '@/stores/authPageTitle';
import { computed, onMounted, watch } from 'vue';
import { useHttpAuth } from '@/http/auth';
import NavDropdownTrigger from '@/widgets/nav/NavDropdownTrigger.vue';
import NavDropdownButton from '@/widgets/nav/NavDropdownButton.vue';
import NavDropdownLink from '@/widgets/nav/NavDropdownLink.vue';
import LegislationSidebarLinks from './authenticated-layout-partials/LegislationSidebarLinks.vue';
import FormSidebarLinks from './authenticated-layout-partials/FormSidebarLinks.vue';
import LegislativeSidebarLinks from './authenticated-layout-partials/LegislativeSidebarLinks.vue';
import CommunicationSidebarLinks from './authenticated-layout-partials/CommunicationSidebarLinks.vue';
import KatarunganSidebarLinks from './authenticated-layout-partials/KatarunganSidebarLinks.vue';
import IssuanceSidebarLinks from './authenticated-layout-partials/IssuanceSidebarLinks.vue';

const appName = import.meta.env.VITE_APP_NAME;
const route = useRoute();
const currentRouteTitle = computed(() => route.meta.title);
const { routeTitle } = storeToRefs(useAuthPageTitleStore());
const { isShow } = storeToRefs(useSidebarStore())
const { setHide, setShow } = useSidebarStore();

const toggleSidebar = () => {
  isShow.value === true ? setHide() : setShow()
}

const closeOnSmallScreen = () => {
  if (window.innerWidth <= 768) setHide()
}

onMounted(() => {
  routeTitle.value = currentRouteTitle.value;
})

watch(currentRouteTitle, (currentRouteTitle) => {
  routeTitle.value = currentRouteTitle;
})
</script>

<template>
  <div class="relative text-sm">
    <div
      :class="isShow ? 'md:ml-[300px]' : 'md:ml-0'"
      class="bg-white dark:bg-zinc-800 pt-4 p-2 fixed top-0 right-0 left-0 flex justify-between items-center border-b dark:border-zinc-700 shadow transition-transform z-10">
      <ExtraButton @click="toggleSidebar">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
      </ExtraButton>

      <div class="dark:text-emerald-400 text-emerald-600 font-semibold absolute left-1/2 -translate-x-1/2 uppercase">
        {{ routeTitle }}
      </div>

      <UserDropdown />
    </div>
    
    <aside 
      id="default-sidebar" 
      :class="isShow ? 'translate-x-0' : '-translate-x-full'"
      class="fixed top-0 left-0 z-40 w-[300px] h-screen transition-transform bg-gradient-to-b from-emerald-900 to-zinc-900 border-r border-emerald-800" aria-label="Sidebar">
      <div class="px-3 py-4 pt-5">
        <h2 class="text-white font-black uppercase md:text-center text-lg">
          <RouterLink to="/" class="hover:text-emerald-400 transition-colors">
            {{ appName }}
          </RouterLink>
          <p class="text-xs uppercase font-normal text-emerald-300">
            Barangay Records and Analysis Information Network System
          </p>
        </h2>
        <button @click="setHide()" type="button" class="md:hidden text-emerald-400 bg-transparent hover:bg-emerald-800 hover:text-white rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center transition-colors">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close menu</span>
        </button>
      </div>
      <div class="h-[90%] px-3 py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
          <li>
            <RouterLink to="/dashboard" @click="closeOnSmallScreen" active-class="bg-emerald-800" class="flex items-center p-2 rounded-lg text-white hover:bg-emerald-800/50 group transition-colors">
              <span class="w-5 h-5 transition duration-75 text-emerald-400 group-hover:text-white">
                <i class="ri-home-fill"></i>
              </span>
              <span class="ms-2">Dashboard</span>
            </RouterLink>
          </li>
          <li>
            <IssuanceSidebarLinks />
          </li>
          <li>
            <FormSidebarLinks />
          </li>
          <li>
            <LegislationSidebarLinks />
          </li>
          <li>
            <LegislativeSidebarLinks />
          </li>
          <li>
            <CommunicationSidebarLinks />
          </li>
          <li>
            <KatarunganSidebarLinks />
          </li>
          <li>
            <NavDropdownLink to="/vawc" class="hover:bg-emerald-800/50 transition-colors">
              <i class="ri-speak-line text-emerald-400"></i>
              <span class="ms-2">VAWC</span>
            </NavDropdownLink>
          </li>
          <li>
            <ThemeToggler />
          </li>
        </ul>
      </div>
    </aside>
    
    <div
      :class="isShow ? 'md:ml-[300px]' : 'md:ml-0'"
      class="p-4 bg-zinc-50 dark:bg-zinc-900 min-h-screen dark:text-zinc-400 transition-transform pt-20">

      <div
        :class="isShow ? 'opacity-100' : 'opacity-0 invisible'" 
        @click.self="setHide()"
        class="backdrop-blur-sm bg-emerald-400/20 duration-200 dark:bg-emerald-950/30 md:hidden z-30 fixed left-0 right-0 top-0 bottom-0"
      ></div>
      <slot/>
    </div>
  </div>
</template>