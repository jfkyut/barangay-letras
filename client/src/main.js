import './assets/main.css'
import './config/http';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Toast from 'vue-toastification';
import "vue-toastification/dist/index.css";
import "remixicon/fonts/remixicon.css";

import App from './App.vue'
import router from './router'
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import Material from '@primeuix/themes/material';

// import '@primeuix/themes/dist/lara';
import Lara from '@primeuix/themes/lara';
import Nora from '@primeuix/themes/nora';


const app = createApp(App)

const options = {
  position: "top-center",
  timeout: 5000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: false,
  closeButton: "button",
  icon: true,
  rtl: false
}

app.use(Toast, options);
app.use(createPinia())
app.use(PrimeVue, {
    theme: {
        preset: Aura,
        options: {
            darkModeSelector: '.dark',
            cssLayer: false,
        },
    },
    ripple: true
});
app.use(router)

app.mount('#app')
