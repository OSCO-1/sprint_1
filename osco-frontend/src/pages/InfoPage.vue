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
      <p>{{ getLocalizedText(content.errorMessage) }}</p>
    </div>
    
    <!-- Main Content -->
    <div v-for="restaurant in restaurantInfos" :key="restaurant.id" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

      <!-- Hero Section -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="h-64 lg:h-80 bg-cover bg-center"
             :style="{ backgroundImage: `url(${restaurant.image})` }">
          <div class="h-full bg-black bg-opacity-30 flex items-end">
            <div class="p-6 lg:p-8 text-white">
              <h2 class="text-3xl lg:text-4xl font-bold mb-2">{{ getLocalizedText(content.welcome) }} {{ restaurant.name }}</h2>
              <p class="text-lg lg:text-xl opacity-90">{{ restaurant.headline }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- About Section -->
      <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8 mb-8">
        <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">{{ getLocalizedText(content.aboutUs) }}</h3>
        <div class="prose lg:prose-lg max-w-none text-gray-600 text-justify">
          <p class="mb-4">
            {{ restaurant.description }}
          </p>
        </div>
      </div>

      <!-- Contact, Hours & Social Media Grid -->
      <div class="grid md:grid-cols-2 gap-8 mb-8">
        
        <!-- Contact Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            {{ getLocalizedText(content.contact) }}
          </h3>
          
          <div class="space-y-4">
            <div class="flex items-start">
              <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <div>
                <p class="font-medium text-gray-900">{{ getLocalizedText(content.address) }}</p>
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
                <p class="font-medium text-gray-900">{{ getLocalizedText(content.phone) }}</p>
                <p class="text-gray-600">{{ restaurant.phone_number }}</p>
                <p class="text-gray-600">{{ restaurant.phone_fix }}</p>                
              </div>
            </div>
            
            <div class="flex items-start">
              <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <div>
                <p class="font-medium text-gray-900">{{ getLocalizedText(content.email) }}</p>
                <p class="text-gray-600">{{ restaurant.gmail }}</p>
              </div>
            </div>

            <!-- Social Media Links -->
            <div class="flex items-start">
              <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
              </svg>
              <div>
                <p class="font-medium text-gray-900">{{ getLocalizedText(content.followUs) }}</p>
                <div class="flex space-x-4 mt-2">
                  <a v-if="restaurant.facebook" :href="restaurant.facebook" target="_blank" class="text-gray-600 hover:text-orange-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 2.04c-5.5 0-9.96 4.46-9.96 9.96 0 5.06 3.75 9.24 8.64 9.9v-7h-2.58v-2.9h2.58v-2.2c0-2.55 1.53-3.95 3.85-3.95 1.1 0 2.04.08 2.32.12v2.7h-1.58c-1.24 0-1.48.59-1.48 1.45v1.9h2.96l-.39 2.9h-2.57v7c4.89-.66 8.64-4.84 8.64-9.9 0-5.5-4.46-9.96-9.96-9.96z"/>
                    </svg>
                  </a>
                  <a v-if="restaurant.instagram" :href="restaurant.instagram" target="_blank" class="text-gray-600 hover:text-orange-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 2.16c3.2 0 3.58.01 4.84.07 1.17.06 1.8.24 2.22.4.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.34 1.05.4 2.22.06 1.26.07 1.64.07 4.84s-.01 3.58-.07 4.84c-.06 1.17-.24 1.8-.4 2.22-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.05.34-2.22.4-1.26.06-1.64.07-4.84.07s-3.58-.01-4.84-.07c-1.17-.06-1.8-.24-2.22-.4-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.34-1.05-.4-2.22-.06-1.26-.07-1.64-.07-4.84s.01-3.58.07-4.84c.06-1.17.24-1.8.4-2.22.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.05-.34 2.22-.4 1.26-.06 1.64-.07 4.84-.07zm0-2.16c-3.25 0-3.66.01-4.94.07-1.28.06-2.16.26-2.92.56-.79.31-1.46.72-2.12 1.38-.66.66-1.07 1.33-1.38 2.12-.3.76-.5 1.64-.56 2.92-.06 1.28-.07 1.69-.07 4.94s.01 3.66.07 4.94c.06 1.28.26 2.16.56 2.92.31.79.72 1.46 1.38 2.12.66.66 1.33 1.07 2.12 1.38.76.3 1.64.5 2.92.56 1.28.06 1.69.07 4.94.07s3.66-.01 4.94-.07c1.28-.06 2.16-.26 2.92-.56.79-.31 1.46-.72 2.12-1.38.66-.66 1.07-1.33 1.38-2.12.3-.76.5-1.64.56-2.92.06-1.28.07-1.69.07-4.94s-.01-3.66-.07-4.94c-.06-1.28-.26-2.16-.56-2.92-.31-.79-.72-1.46-1.38-2.12-.66-.66-1.33-1.07-2.12-1.38-.76-.3-1.64-.5-2.92-.56-1.28-.06-1.69-.07-4.94-.07zm0 5.83a6.17 6.17 0 100 12.34 6.17 6.17 0 000-12.34zm0 10.18a4.01 4.01 0 110-8.02 4.01 4.01 0 010 8.02zm6.44-10.62a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                    </svg>
                  </a>
                  <a v-if="restaurant.youtube" :href="restaurant.youtube" target="_blank" class="text-gray-600 hover:text-orange-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M23.5 6.5c-.3-1.1-1.1-2-2.2-2.3C19.2 4 12 4 12 4s-7.2 0-9.3.2c-1.1.3-1.9 1.2-2.2 2.3C.2 8.6 0 11.1 0 12s.2 3.4.5 5.5c.3 1.1 1.1 2 2.2 2.3 2.1.2 9.3.2 9.3.2s7.2 0 9.3-.2c1.1-.3 1.9-1.2 2.2-2.3.3-2.1.5-4.6.5-5.5s-.2-3.4-.5-5.5zM9.6 16.4V7.6l6.2 4.4-6.2 4.4z"/>
                    </svg>
                  </a>
                  <a v-if="restaurant.snapchat" :href="restaurant.snapchat" target="_blank" class="text-gray-600 hover:text-orange-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm0 2.4c3.31 0 6 2.69 6 6 0 1.65-.67 3.14-1.76 4.23-.48.48-.76.88-.76 1.45 0 .58.29 1.09.76 1.45-.18.11-.37.22-.57.31-1.06.46-2.2.69-3.43.69-1.23 0-2.37-.23-3.43-.69-.2-.09-.39-.2-.57-.31.47-.36.76-.87.76-1.45 0-.57-.28-1.08-.76-1.45C6.67 11.14 6 9.65 6 8c0-3.31 2.69-6 6-6zm4.8 12.6c-.47-.36-.76-.87-.76-1.45 0-.57.28-1.08.76-1.45.47-.36.76-.87.76-1.45 0-.58-.29-1.09-.76-1.45-.48-.48-1.12-.88-1.76-1.14-.64-.26-1.31-.39-2-.39s-1.36.13-2 .39c-.64.26-1.28.66-1.76 1.14-.47.36-.76.87-.76 1.45 0 .58.29 1.09.76 1.45.47.36.76.87.76 1.45 0 .58-.29 1.09-.76 1.45-.18.11-.37.22-.57.31-1.06.46-2.2.69-3.43.69-.29 0-.58-.02-.86-.06.47-.36.76-.87.76-1.45 0-.57-.28-1.08-.76-1.45-.47-.36-.76-.87-.76-1.45 0-.58.29-1.09.76-1.45C3.67 5.14 6.69 2.4 12 2.4s8.33 2.74 8.33 6c0 1.65-.67 3.14-1.76 4.23-.48.48-.76.88-.76 1.45 0 .58.29 1.09.76 1.45-.18.11-.37.22-.57.31-1.06.46-2.2.69-3.43.69-.29 0-.58-.02-.86-.06z"/>
                    </svg>
                  </a>
                  <a v-if="restaurant.tiktok" :href="restaurant.tiktok" target="_blank" class="text-gray-600 hover:text-orange-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm6.75 8.25c-.45.81-1.08 1.53-1.89 2.07-.27-.81-.45-1.65-.45-2.52 0-2.79-2.25-5.04-5.04-5.04-1.08 0-2.07.36-2.88.99v-.99h-2.25v12.6c0 1.26.99 2.25 2.25 2.25s2.25-.99 2.25-2.25V11.7c.81.36 1.71.54 2.61.54 2.79 0 5.04-2.25 5.04-5.04 0-.54-.09-1.08-.27-1.62.81.27 1.53.72 2.07 1.35v-1.89h-1.44z"/>
                    </svg>
                  </a>
                </div>
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
            {{ getLocalizedText(content.openingHours) }}
          </h3>
          
          <div class="space-y-3">
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="font-medium text-gray-900">{{ getLocalizedText(content.monday) }}</span>
              <span class="text-gray-600">11:30 - 22:00</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="font-medium text-gray-900">{{ getLocalizedText(content.friday) }}</span>
              <span class="text-gray-600">11:30 - 23:00</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
              <span class="font-medium text-gray-900">{{ getLocalizedText(content.sunday) }}</span>
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
          {{ getLocalizedText(content.viewMenu) }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { getRestaurantInfo, restaurantInfos, error, isLoading } from '../stores/restaurant';
import { onMounted } from 'vue';
import { 
  currentLanguage, 
  initializeLanguage 
} from '@/stores/language';

// Multi-language content
const content = {
  welcome: {
    fr: 'Bienvenue chez',
    en: 'Welcome to',
    ar: 'مرحباً بكم في'
  },
  aboutUs: {
    fr: 'À Propos de Nous',
    en: 'About Us',
    ar: 'معلومات عنا'
  },
  contact: {
    fr: 'Contact',
    en: 'Contact',
    ar: 'اتصل بنا'
  },
  address: {
    fr: 'Adresse',
    en: 'Address',
    ar: 'العنوان'
  },
  phone: {
    fr: 'Téléphone',
    en: 'Phone',
    ar: 'الهاتف'
  },
  email: {
    fr: 'Email',
    en: 'Email',
    ar: 'البريد الإلكتروني'
  },
  followUs: {
    fr: 'Suivez-nous',
    en: 'Follow us',
    ar: 'تابعونا'
  },
  openingHours: {
    fr: 'Horaires d\'Ouverture',
    en: 'Opening Hours',
    ar: 'ساعات العمل'
  },
  monday: {
    fr: 'Lundi - Jeudi',
    en: 'Monday - Thursday',
    ar: 'الاثنين - الخميس'
  },
  friday: {
    fr: 'Vendredi - Samedi',
    en: 'Friday - Saturday',
    ar: 'الجمعة - السبت'
  },
  sunday: {
    fr: 'Dimanche',
    en: 'Sunday',
    ar: 'الأحد'
  },
  viewMenu: {
    fr: 'Voir Notre Menu',
    en: 'View Our Menu',
    ar: 'عرض قائمتنا'
  },
  errorMessage: {
    fr: 'Erreur lors du chargement des informations du restaurant.',
    en: 'Error loading restaurant information.',
    ar: 'خطأ في تحميل معلومات المطعم.'
  }
}

// Helper function to get localized text
const getLocalizedText = (textObject) => {
  const langCode = currentLanguage.value.dbField
  return textObject[langCode] || textObject.fr || textObject.en
}

onMounted(() => {
  initializeLanguage();
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