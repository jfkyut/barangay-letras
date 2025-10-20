import GuestLayoutVue from '@/layouts/guest/GuestLayout.vue';
import guards from '../guards/guards';
import LandingLayout from '@/layouts/landing/LandingLayout.vue';

const { guest, authenticated, notVerified } = guards();

const landingRoutes = [
  {
    path: '/',
    name: 'landing',
    component: () => import('@/views/landing/Landing.vue'),
    meta: {
      layout: LandingLayout,
      title: 'Home'
    },
  }
];

export default landingRoutes;