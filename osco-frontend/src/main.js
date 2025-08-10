import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import 'aos/dist/aos.css?inline'
import AOS from 'aos'

createApp(App).use(router).mount('#app')

// Initialize AOS (Animate On Scroll) library
AOS.init();