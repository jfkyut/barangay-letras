import AuthenticatedLayout from '@/layouts/auth/AuthenticatedLayout.vue';
import guards from '@/router/guards/guards';
const { authenticated, verified } = guards();

const authenticatedRoutes = [
  {
    path: '/home',
    alias: ['/home', '/dashboard'],
    name: 'home',
    component: () => import('@/views/home/HomeView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Dashboard'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/account',
    name: 'account',
    component: () => import('@/views/profile/ProfileView.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Account'
    },
    beforeEnter: [authenticated, verified]
  },

  // legislations
  {
    path: '/resolutions',
    name: 'legislation.resolution.index',
    component: () => import('@/views/legislation/Resolution.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Resolutions'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/ordinances',
    name: 'legislation.ordinance.index',
    component: () => import('@/views/legislation/Ordinance.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Ordinances'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/appropriation-ordinances',
    name: 'legislation.appropriation-ordinance.index',
    component: () => import('@/views/legislation/ApproOrdinance.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Appropriation Ordinances'
    },
    beforeEnter: [authenticated, verified]
  },

  // communications
  {
    path: '/incoming-communications',
    name: 'incoming-communication.index',
    component: () => import('@/views/incoming-communication/Incoming.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Incoming Communications'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/outgoing-communications',
    name: 'outgoing-communication.index',
    component: () => import('@/views/outgoing-communication/Outgoing.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Outgoing Communication'
    },
    beforeEnter: [authenticated, verified]
  },

  // katarungan
  {
    path: '/punong-barangay-mediation',
    name: 'katarungan.punong-barangay',
    component: () => import('@/views/katarungan/PunongBarangayMediation.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Punong Barangay Mediation'
    },
    beforeEnter: [authenticated, verified]
  },
  {
    path: '/lupong-tagapamayapa',
    name: 'katarungan.lupong-tagapamayapa',
    component: () => import('@/views/katarungan/LupongTagapamayapa.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Lupong Tagapamayapa'
    },
    beforeEnter: [authenticated, verified]
  },

  // vawc
  {
    path: '/vawc',
    name: 'vawc.index',
    component: () => import('@/views/vawc/Vawc.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'VAWC'
    },
    beforeEnter: [authenticated, verified]
  },

  // sessions
  {
    path: '/session',
    name: 'legislative.session.index',
    component: () => import('@/views/session/Session.vue'),
    meta: {
      layout: AuthenticatedLayout,
      title: 'Sessions'
    },
    beforeEnter: [authenticated, verified]
  },
];

export default authenticatedRoutes;