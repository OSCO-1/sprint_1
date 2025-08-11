<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-6">
        <div class="flex items-center">
          <!-- Back button -->
          <button 
            @click="goBack"
            class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          
          <!-- Restaurant Logo and Name -->
          <div class="flex items-center">
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center shadow-md">
              <span class="text-white font-bold text-lg lg:text-xl">CR</span>
            </div>
          </div>
          
          <div class="w-20"></div> <!-- Spacer for centering -->
        </div>
      </div>
    </div>
    
    <!-- Loading State -->
    <div v-if="isLoading" class="flex justify-center items-center py-12">
      <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-500"></div>
    </div>
    
    <!-- Error State -->
    <div v-if="error && !isLoading" class="text-red-500 text-center py-4">
      <p>Erreur lors du chargement des informations du restaurant.</p>
    </div>
    
    <!-- Main Content -->
    <div v-for="restaurant in restaurantInfos" :key="restaurant.id" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

      <!-- Hero Section -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="h-64 lg:h-80 bg-cover bg-center"
             :style="{ backgroundImage: `url(${restaurant.image})` }">
          <div class="h-full bg-black bg-opacity-30 flex items-end">
            <div class="p-6 lg:p-8 text-white">
              <h2 class="text-3xl lg:text-4xl font-bold mb-2">Bienvenue chez {{ restaurant.name }}</h2>
              <p class="text-lg lg:text-xl opacity-90">{{ restaurant.headline }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- About Section -->
      <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8 mb-8">
        <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">À Propos de Nous</h3>
        <div class="prose lg:prose-lg max-w-none text-gray-600 text-justify">
          <p class="mb-4">
            {{ restaurant.description }}
          </p>
        </div>
      </div>

      <!-- Contact & Hours Grid -->
      <div class="grid md:grid-cols-2 gap-8 mb-8">
        
        <!-- Contact Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            Contact
          </h3>
          
          <div class="space-y-4">
            <div class="flex items-start">
              <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <div>
                <p class="font-medium text-gray-900">Adresse</p>
                <p class="text-gray-600">
                  {{ restaurant.address }}
                </p>
              </div>
            </div>
            
            <div class="flex items-start">
              <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <div>
                <p class="font-medium text-gray-900">Téléphone</p>
                <p class="text-gray-600">{{ restaurant.phone_number }}</p>
                <p class="text-gray-600">{{ restaurant.phone_fix }}</p>                
              </div>
            </div>
            
            <div class="flex items-start">
              <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <div>
                <p class="font-medium text-gray-900">Email</p>
                <p class="text-gray-600">{{ restaurant.gmail }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Opening Hours -->
        <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Horaires d'Ouverture
          </h3>
          
          <div class="space-y-3">
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="font-medium text-gray-900">Lundi - Jeudi</span>
              <span class="text-gray-600">11:30 - 22:00</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="font-medium text-gray-900">Vendredi - Samedi</span>
              <span class="text-gray-600">11:30 - 23:00</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="font-medium text-gray-900">Dimanche</span>
              <span class="text-gray-600">12:00 - 21:00</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Call to Action -->
      <div class="text-center">
        <button 
          @click="goToMenu"
          class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-4 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl mr-4"
        >
          Voir Notre Menu
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { getRestaurantInfo, restaurantInfos, error, isLoading } from '../stores/restaurant';
import { onMounted } from 'vue';


onMounted(() => {
  getRestaurantInfo();
});

const router = useRouter()

const goBack = () => {
  router.go(-1)
}

const goToMenu = () => {
  router.push('/menu')
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

* {
  font-family: 'Inter', sans-serif;
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

/* Prose styling */
.prose {
  line-height: 1.7;
}

.prose p {
  margin-bottom: 1rem;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: #a1a1a1;
}
</style>
