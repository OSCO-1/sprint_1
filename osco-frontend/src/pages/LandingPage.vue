<template>
  <div class="h-screen overflow-hidden bg-cover bg-center bg-no-repeat relative" 
       style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')">
    
    <!-- Dark overlay for better text readability -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    
    <!-- Header with language selector -->
    <div class="relative z-10 flex justify-between items-center p-4 lg:p-6">
      <div class="text-yellow-500 font-bold text-lg">AVINIDA</div>
      <div class="relative">
        <!-- Language Selector Button -->
        <button 
          @click="toggleLanguageDropdown"
          class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg px-3 py-2 text-white hover:bg-white/20 transition-all duration-200"
        >
          <img :src="currentLanguage.flag" :alt="currentLanguage.code" class="w-5 h-3 rounded-sm">
          <span class="text-sm font-medium">{{ currentLanguage.name }}</span>
          <svg 
            class="w-4 h-4 transition-transform duration-200" 
            :class="{ 'rotate-180': isLanguageDropdownOpen }"
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>

        <!-- Language Dropdown -->
        <div 
          v-if="isLanguageDropdownOpen"
          class="absolute right-0 mt-2 w-48 bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg overflow-hidden z-50"
        >
          <button
            v-for="language in languages"
            :key="language.code"
            @click="setLanguage(language.code)"
            class="w-full flex items-center space-x-3 px-4 py-3 text-gray-800 hover:bg-orange-50 transition-colors duration-200"
            :class="{ 'bg-orange-100': selectedLanguage === language.code }"
          >
            <img :src="language.flag" :alt="language.code" class="w-5 h-3 rounded-sm">
            <span class="text-sm font-medium">{{ language.name }}</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Main content container -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 lg:px-6 pb-32">
      <!-- Restaurant name and description -->
      <div class="text-center mb-8 lg:mb-12">
        <h1 class="text-4xl lg:text-6xl font-bold text-white mb-2 lg:mb-4 font-serif">
          {{ getLocalizedText(content.welcome) }}
        </h1>
        <h2 class="text-3xl lg:text-5xl font-bold text-yellow-500 mb-2 font-serif">
          {{ getLocalizedText(content.restaurantName) }}
        </h2>
      </div>

      <!-- Menu button -->
      <button 
        @click="goToMenu"
        class="bg-orange-500 text-white px-8 lg:px-12 py-3 lg:py-4 text-base lg:text-lg font-semibold rounded-lg hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
      >
        {{ getLocalizedText(content.menuButton) }}
      </button>
    </div>

    <!-- Bottom navigation icons - Fixed positioning -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-10">
      <div class="flex space-x-6 bg-white/10 backdrop-blur-sm p-3 rounded-full shadow-lg border border-white/20">
        <button class="text-white hover:text-yellow-500 transition-colors duration-200 p-2">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
          </svg>
        </button>
        <button 
          @click="goToInfo"
          class="text-white hover:text-yellow-500 transition-colors duration-200 p-2"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="3"></circle>
            <path d="M12 1v6m0 6v6m11-7h-6m-6 0H1"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'
import { 
  selectedLanguage, 
  isLanguageDropdownOpen, 
  languages, 
  currentLanguage, 
  setLanguage, 
  toggleLanguageDropdown, 
  initializeLanguage 
} from '@/stores/language'

const router = useRouter()

// Multi-language content
const content = {
  welcome: {
    fr: 'Restaurant',
    en: 'Restaurant',
    ar: 'مطعم'
  },
  restaurantName: {
    fr: 'Avinida',
    en: 'Avinida', 
    ar: 'أفينيدا'
  },
  menuButton: {
    fr: 'Notre menu',
    en: 'Our menu',
    ar: 'قائمتنا'
  }
}

// Helper function to get localized text
const getLocalizedText = (textObject) => {
  const langCode = currentLanguage.value.dbField
  return textObject[langCode] || textObject.fr || textObject.en
}

// Navigation methods
const goToMenu = () => {
  router.push('/menu')
}

const goToInfo = () => {
  router.push('/info')
}

// Initialize language on mount
onMounted(() => {
  initializeLanguage()
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;500;600;700&display=swap');

.font-serif {
  font-family: 'Playfair Display', serif;
}

/* Custom hexagon shapes using clip-path for more authentic look */
.hexagon {
  width: 40px;
  height: 40px;
  background: #f59e0b;
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
}

.hexagon-black {
  width: 40px;
  height: 40px;
  background: #000000;
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
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
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.5);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .hexagon, .hexagon-black {
    width: 32px;
    height: 32px;
  }
}
</style>