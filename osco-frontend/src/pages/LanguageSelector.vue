<template>
  <div class="min-h-screen bg-gradient-to-br from-orange-400 via-red-500 to-pink-500 flex items-center justify-center px-4">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute inset-0 bg-pattern"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-md w-full">
      <!-- Logo and Welcome -->
      <div class="text-center mt-8">
        <!-- Logo with hexagon pattern -->
        <div class="mb-8">
          <div class="relative mx-auto w-24 h-24">
            <!-- Hexagon pattern -->
            <div class="flex flex-wrap justify-center items-center mb-2">
              <!-- Top row -->
              <div class="flex">
                <div class="w-6 h-6 bg-yellow-300 transform rotate-45 mx-0.5 mb-1"></div>
                <div class="w-6 h-6 bg-yellow-300 transform rotate-45 mx-0.5 mb-1"></div>
                <div class="w-6 h-6 bg-yellow-300 transform rotate-45 mx-0.5 mb-1"></div>
              </div>
            </div>
            <!-- Bottom row -->
            <div class="flex justify-center">
              <div class="flex">
                <div class="w-6 h-6 bg-white transform rotate-45 mx-0.5"></div>
                <div class="w-6 h-6 bg-white transform rotate-45 mx-0.5"></div>
                <div class="w-6 h-6 bg-white transform rotate-45 mx-0.5"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Language Selection -->
      <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sélectionnez votre langue</h1>
        <div class="space-y-4">
          <!-- French -->
          <button 
            @click="selectLanguage('fr')"
            class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 rounded-xl transition-all duration-300 transform hover:scale-105 group border-2 border-transparent hover:border-orange-200"
          >
            <div class="flex items-center">
              <img src="https://flagcdn.com/w40/fr.png" alt="French" class="w-8 h-6 mr-4 rounded">
              <h2 class="text-gray-800 font-semibold">Français</h2>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- Dutch -->
          <button 
            @click="selectLanguage('nl')"
            class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 rounded-xl transition-all duration-300 transform hover:scale-105 group border-2 border-transparent hover:border-orange-200"
          >
            <div class="flex items-center">
              <img src="https://flagcdn.com/w40/nl.png" alt="Dutch" class="w-8 h-6 mr-4 rounded">
              <h2 class="text-gray-800 font-semibold">Nederlands</h2>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- English -->
          <button 
            @click="selectLanguage('en')"
            class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 rounded-xl transition-all duration-300 transform hover:scale-105 group border-2 border-transparent hover:border-orange-200"
          >
            <div class="flex items-center">
              <img src="https://flagcdn.com/w40/gb.png" alt="English" class="w-8 h-6 mr-4 rounded">
              <h2 class="text-gray-800 font-semibold">English</h2>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>

          <!-- German -->
          <button 
            @click="selectLanguage('de')"
            class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 rounded-xl transition-all duration-300 transform hover:scale-105 group border-2 border-transparent hover:border-orange-200"
          >
            <div class="flex items-center">
              <img src="https://flagcdn.com/w40/de.png" alt="German" class="w-8 h-6 mr-4 rounded">
              <h2 class="text-gray-800 font-semibold">Deutsch</h2>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Loading state -->
      <div v-if="isLoading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 text-center">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-500 mx-auto mb-4"></div>
          <p class="text-gray-600">Chargement...</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isLoading = ref(false)

const selectLanguage = async (language) => {
  isLoading.value = true
  
  // Store selected language in localStorage for future use
  localStorage.setItem('selectedLanguage', language)
  localStorage.setItem('languageSelected', 'true')
  
  // Simulate a brief loading time for better UX
  await new Promise(resolve => setTimeout(resolve, 800))
  
  // Navigate to landing page
  router.push('/landing')
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;500;600;700&display=swap');

.font-serif {
  font-family: 'Playfair Display', serif;
}

/* Smooth transitions */
button {
  transition: all 0.3s ease;
}

button:active {
  transform: scale(0.98);
}

/* Focus states */
button:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.5);
}

/* Animation for loading spinner */
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.animate-spin {
  animation: spin 1s linear infinite;
}

/* Background pattern */
.bg-pattern {
  background-image: repeating-linear-gradient(
    45deg,
    transparent,
    transparent 10px,
    rgba(255, 255, 255, 0.05) 10px,
    rgba(255, 255, 255, 0.05) 20px
  );
}

/* Custom hover effects */
.group:hover .group-hover\:text-orange-600 {
  color: #ea580c;
}

.group:hover .group-hover\:text-orange-500 {
  color: #f97316;
}
</style>
