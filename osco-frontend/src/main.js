import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import 'aos/dist/aos.css'
import AOS from 'aos'

const app = createApp(App)
app.use(router)

// Mount the app first
app.mount('#app')

// Initialize AOS after the app is mounted
setTimeout(() => {
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        offset: 100,
        delay: 0
    });
}, 100);