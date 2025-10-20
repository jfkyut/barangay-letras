import { createRouter, createWebHistory } from 'vue-router'
import guest from './routes/guest'
import authenticated from './routes/authenticated'
import errorRoutes from './routes/error'
import landingRoutes from './routes/landing'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  },
  routes: [
    ...guest,
    ...authenticated,
    ...landingRoutes,
    ...errorRoutes,
  ]
})

router.beforeEach((to) => {

  const pageTitle = to.meta.title;

  const appTitle = import.meta.env.VITE_APP_NAME || 'Vue Starter';

  document.title = pageTitle 
    ? `${pageTitle} | ${appTitle}` 
    : appTitle;
});

export default router
