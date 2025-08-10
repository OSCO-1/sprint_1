<template>
  <div class="min-h-screen bg-cover bg-center bg-no-repeat relative" 
       style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')">
    
    <!-- Dark overlay for better text readability -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    
    <!-- Header with language selector -->
    <div class="relative z-10 flex justify-between items-center p-4 lg:p-6">
      <div class="text-white font-bold text-lg">COMPARTO</div>
      <div class="flex items-center space-x-2">
        <img src="https://flagcdn.com/w20/nl.png" alt="NL" class="w-5 h-3">
        <span class="text-white text-sm">NL</span>
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </div>
    </div>

    <!-- Main content -->
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 lg:px-6">
      
      <!-- Logo with hexagon pattern -->
      <div class="mb-8 lg:mb-12">
        <div class="relative">
          <!-- Hexagon pattern -->
          <div class="flex flex-wrap justify-center items-center mb-4">
            <!-- Top row -->
            <div class="flex">
              <div class="w-8 h-8 lg:w-10 lg:h-10 bg-yellow-500 transform rotate-45 mx-1 mb-2"></div>
              <div class="w-8 h-8 lg:w-10 lg:h-10 bg-yellow-500 transform rotate-45 mx-1 mb-2"></div>
              <div class="w-8 h-8 lg:w-10 lg:h-10 bg-yellow-500 transform rotate-45 mx-1 mb-2"></div>
            </div>
          </div>
          <!-- Bottom row -->
          <div class="flex justify-center">
            <div class="flex">
              <div class="w-8 h-8 lg:w-10 lg:h-10 bg-black transform rotate-45 mx-1"></div>
              <div class="w-8 h-8 lg:w-10 lg:h-10 bg-black transform rotate-45 mx-1"></div>
              <div class="w-8 h-8 lg:w-10 lg:h-10 bg-black transform rotate-45 mx-1"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Restaurant name and description -->
      <div class="text-center mb-12 lg:mb-16">
        <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4 font-serif">
          Cafe Restaurant
        </h1>
        <h2 class="text-3xl lg:text-5xl font-bold text-white mb-6 font-serif">
          Comparto
        </h2>
        <p class="text-white text-lg lg:text-xl opacity-90 max-w-md mx-auto">
          Experience authentic flavors in a warm and welcoming atmosphere
        </p>
      </div>

      <!-- Menu button -->
      <button 
        @click="goToMenu"
        class="bg-black text-white px-12 lg:px-16 py-4 lg:py-5 text-lg lg:text-xl font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
      >
        Notre menu
      </button>

      <!-- Bottom navigation icons -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-8">
        <button class="text-white hover:text-yellow-500 transition-colors duration-200">
          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
          </svg>
        </button>
        <button 
          @click="goToInfo"
          class="text-white hover:text-yellow-500 transition-colors duration-200"
        >
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

const router = useRouter()

const goToMenu = () => {
  router.push('/menu')
}

const goToInfo = () => {
  router.push('/info')
}
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
