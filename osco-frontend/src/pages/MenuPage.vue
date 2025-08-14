<script setup>
import { categoryItems, isLoading, error, getCategoryItems } from '@/stores/categoryItem';
import { menuItems, getMenuItems, filterMenuItemsByCategory, searchItems } from '@/stores/menuItem';
import { computed, onMounted, ref, nextTick, watch } from 'vue';
import Detail from '@/components/DetailView.vue';
import { Search, X } from 'lucide-vue-next';
import AOS from 'aos';
import router from '@/router';

// Define searchTerm for the search bar
const searchTerm = ref('');
const selectedCategory = ref(null);

// Define a method to get menu items by ID
const shadowDetail = ref(false);
const selectedItem = ref(null);

// Language selector state
const isLanguageDropdownOpen = ref(false);
const selectedLanguage = ref({
  code: 'fr',
  name: 'Français',
  flag: 'https://flagcdn.com/w20/fr.png'
});

const languages = [
  {
    code: 'fr',
    name: 'Français',
    flag: 'https://flagcdn.com/w20/fr.png'
  },
  {
    code: 'nl',
    name: 'Nederlands',
    flag: 'https://flagcdn.com/w20/nl.png'
  },
  {
    code: 'en',
    name: 'English',
    flag: 'https://flagcdn.com/w20/gb.png'
  },
  {
    code: 'de',
    name: 'Deutsch',
    flag: 'https://flagcdn.com/w20/de.png'
  }
];

//handle item selection
const handleItemSelect = (item) => {
  selectedItem.value = item;
  shadowDetail.value = true;
};

// Computed property for filtered menu items
const filteredMenuItems = computed(() => {
  if (searchTerm.value.trim()) {
    return searchItems(searchTerm.value);
  }
  return menuItems.value;
});
// Language selector methods
const toggleLanguageDropdown = () => {
  isLanguageDropdownOpen.value = !isLanguageDropdownOpen.value;
};

const selectLanguage = (language) => {
  selectedLanguage.value = language;
  isLanguageDropdownOpen.value = false;
};

// Navigation methods
const goBack = () => {
  router.go(-1);
};

// Handle category filtering
const handleCategoryFilter = async (categoryId) => {
  selectedCategory.value = categoryId;
  searchTerm.value = ''; // Clear search when filtering by category
  await filterMenuItemsByCategory(categoryId);
  // Refresh AOS after content changes
  await nextTick();
  AOS.refresh();
};

// Handle showing all items
const showAllItems = async () => {
  selectedCategory.value = null;
  searchTerm.value = '';
  await getMenuItems();
  // Refresh AOS after content changes
  await nextTick();
  AOS.refresh();
};

// Watch for changes in filteredMenuItems and refresh AOS
watch(filteredMenuItems, async () => {
  await nextTick();
  AOS.refresh();
});

// Fetch categories and menu items on mount
onMounted(async () => {
  await getCategoryItems();
  await getMenuItems();
  // Initialize AOS after content is loaded
  await nextTick();
  AOS.refresh();
});
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white px-4 sm:px-6 lg:px-8 py-4 lg:py-6">
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6 lg:mb-8">
          <!-- Restaurant Logo and Name -->
          <div class="flex items-center space-x-1">
              <button 
                @click="goBack"
                class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </button>
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center shadow-md">
              <span class="text-white font-bold text-lg lg:text-xl">AF</span>
            </div>
            <div>
              <h1 class="text-xl lg:text-2xl font-bold text-yellow-500">AVINIDA</h1>
            </div>
          </div>

          <!-- Language Selector -->
          <div class="relative">
            <button 
              @click="toggleLanguageDropdown"
              class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 border border-gray-200 rounded-lg px-3 py-2 text-gray-700 transition-all duration-200"
            >
              <img :src="selectedLanguage.flag" :alt="selectedLanguage.code" class="w-5 h-3 rounded-sm">
              <span class="text-sm font-medium">{{ selectedLanguage.name }}</span>
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
              class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden z-50"
            >
              <button
                v-for="language in languages"
                :key="language.code"
                @click="selectLanguage(language)"
                class="w-full flex items-center space-x-3 px-4 py-3 text-gray-800 hover:bg-orange-50 transition-colors duration-200"
                :class="{ 'bg-orange-100': selectedLanguage.code === language.code }"
              >
                <img :src="language.flag" :alt="language.code" class="w-5 h-3 rounded-sm">
                <span class="text-sm font-medium">{{ language.name }}</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Title -->
        <div class="mb-6 lg:mb-8 flex items-center justify-between">
          <button 
            v-if="selectedCategory"
            @click="showAllItems"
            class="inline-flex items-center text-orange-500 border border-orange-500 rounded-xl lg:rounded-2xl px-4 py-2 hover:text-orange-600 text-sm lg:text-base font-medium transition-colors duration-200"
            title="Show All Items"
          >
            <X class="h-4 w-4 lg:h-5 lg:w-5 mr-1" />
            Clear Filter
          </button>
        </div>

        <!-- Error Message -->
        <div v-if="error" class="mb-6 lg:mb-8 p-4 lg:p-6 bg-red-50 border border-red-200 rounded-xl lg:rounded-2xl text-red-700 text-center text-sm lg:text-base">
          {{ error }}
        </div>

        <!-- Search Bar -->
        <div class="mb-6 lg:mb-8">
          <div class="relative max-w-md lg:max-w-2xl mx-auto lg:mx-0">
            <div class="absolute inset-y-0 left-0 pl-4 lg:pl-6 flex items-center pointer-events-none">
              <Search class="h-4 w-4 lg:h-5 lg:w-5 text-gray-400" />
            </div>
            <input
              v-model="searchTerm"
              type="text"
              placeholder="Search..."
              class="block w-full pl-12 lg:pl-16 pr-4 lg:pr-6 py-3 lg:py-4 bg-gray-100 border-0 rounded-xl lg:rounded-2xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0 text-sm lg:text-base"
            />
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="text-center py-8 lg:py-12">
          <div class="inline-flex items-center space-x-2 lg:space-x-3">
            <div class="animate-spin rounded-full h-5 w-5 lg:h-6 lg:w-6 border-b-2 border-orange-500"></div>
            <p class="text-gray-500 text-sm lg:text-base">Loading categories...</p>
          </div>
        </div>

        <!-- Category List -->
        <div v-else-if="categoryItems && categoryItems.length > 0" class="mb-6 lg:mb-8" data-aos="fade-up" data-aos-delay="200">
          <!-- Mobile: Horizontal scrollable categories -->
          <div class="lg:hidden overflow-x-auto scroll-smooth flex space-x-4 px-4">
            <div v-for="category in categoryItems || []" :key="category.id" class="flex flex-col items-center flex-shrink-0">
              <button 
                @click="handleCategoryFilter(category.id)"
                :class="[
                  'w-14 h-14 rounded-2xl mb-2 flex items-center justify-center overflow-hidden transition-colors duration-200',
                  selectedCategory === category.id ? 'bg-orange-500' : 'bg-gray-100'
                ]"
              >
                <div v-if="category.name === 'Promotions'" class="text-white text-xl font-bold">%</div>
                <img 
                  v-else 
                  :src="`https://oscoapi-hjtj1.sevalla.app/storage${category.image_url}`" 
                  :alt="category.name.en || 'Category'" 
                  class="w-10 h-10 object-cover rounded-xl"
                  @error="handleImageError"
                  @load="handleImageLoad"
                >

              </button>
              <span class="text-xs text-black font-medium text-center">{{ category.name.en }}</span>
            </div>
          </div>

          <!-- Desktop: All categories in a grid -->
          <div class="hidden lg:grid grid-cols-4 xl:grid-cols-6 2xl:grid-cols-8 gap-6">
            <div v-for="category in categoryItems || []" :key="category.id" class="flex flex-col items-center">
              <button 
                @click="handleCategoryFilter(category.id)"
                :class="[
                  'w-20 h-20 xl:w-24 xl:h-24 rounded-3xl mb-3 flex items-center justify-center overflow-hidden transition-all duration-200 hover:scale-105',
                  selectedCategory === category.id ? 'bg-orange-500 shadow-lg' : 'bg-gray-100 hover:bg-gray-200'
                ]"
              >
                <div v-if="category.name === 'Promotions'" class="text-white text-2xl xl:text-3xl font-bold">%</div>
                <img v-else :src="`https://oscoapi-hjtj1.sevalla.app/storage${category.image_url}`" alt="Category" class="w-14 h-14 xl:w-16 xl:h-16 object-cover rounded-2xl">
              </button>
              <span class="text-sm xl:text-base text-black font-medium text-center">{{ category.name.en }}</span>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-8 lg:py-16">
          <div class="text-gray-400 mb-3 lg:mb-6">
            <svg class="mx-auto h-10 w-10 lg:h-16 lg:w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
            </svg>
          </div>
          <h3 class="text-base lg:text-xl font-medium text-gray-900 mb-1 lg:mb-2">No categories found</h3>
          <p class="text-gray-500 text-sm lg:text-base">Please check your API or try again later.</p>
        </div>
      </div>
    </div>

    <!-- Content Area -->
    <div class="px-4 sm:px-6 lg:px-8 pb-6 lg:pb-12">
      <div class="max-w-7xl mx-auto">
        <!-- No Results Message -->
        <div v-if="searchTerm && filteredMenuItems && filteredMenuItems.length === 0" class="text-center py-12 lg:py-20">
          <div class="text-gray-400 mb-4 lg:mb-6">
            <Search class="mx-auto h-12 w-12 lg:h-16 lg:w-16" />
          </div>
          <h3 class="text-lg lg:text-2xl font-medium text-gray-900 mb-2">No items found</h3>
          <p class="text-gray-500 lg:text-lg">Try searching with different keywords.</p>
        </div>

        <!-- Menu Items -->
        <div v-else data-aos="fade-down">
          <!-- Mobile: Single column -->
          <div class="space-y-4 lg:hidden">
            <div
              v-for="item in filteredMenuItems || []"
              :key="item.id"
              class="bg-white rounded-2xl overflow-hidden shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-200"
              @click="handleItemSelect(item)"
            >
              <!-- Placeholder Image Area -->
            <div class="h-40 bg-gray-100 rounded-2xl mb-4 overflow-hidden">
              <img 
                :src="`https://oscoapi-hjtj1.sevalla.app/storage${item.image_url}`"
                alt="{{ item.name.en }}" 
                class="w-full h-full object-cover"
              >
            </div>

              
              <!-- Restaurant Info -->
              <div class="px-4 pb-4">
                <div class="flex items-start justify-between mb-2">
                  <h3 class="text-xl font-bold text-black">{{ item.name.en }}</h3>
                </div>
                
                <p class="text-gray-500 text-sm mb-2 line-clamp-1">
                  {{ item.description.en }}
                </p>
                
                <div class="flex items-center text-gray-400 text-xl text-bold mb-4 text-orange-600">
                  <span>{{ item.base_price }} DH</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Desktop: Grid layout -->
          <div class="hidden lg:grid grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 xl:gap-8">
            <div
              v-for="(item, index) in filteredMenuItems || []"
              :key="item.id"
              class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group cursor-pointer"
              @click="handleItemSelect(item)"
              data-aos="fade-up"
              :data-aos-delay="index * 100"
            >
              <!-- Placeholder Image Area -->
              <div class="h-48 xl:h-56 bg-gray-100 rounded-3xl mb-6 flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                <div class="w-20 h-20 xl:w-24 xl:h-24 bg-gray-200 rounded-2xl flex items-center justify-center group-hover:bg-gray-300 transition-colors">
                  <svg class="w-10 h-10 xl:w-12 xl:h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
              </div>
              
              <!-- Restaurant Info -->
              <div class="px-6 pb-6">
                <div class="flex items-start justify-between mb-3">
                  <h3 class="text-xl xl:text-2xl font-bold text-black group-hover:text-orange-600 transition-colors">{{ item.name.en }}</h3>
                  <!-- <div class="flex items-center space-x-1">
                    <Star class="w-4 h-4 xl:w-5 xl:h-5 text-orange-400 fill-current" />
                    <span class="text-orange-500 font-medium text-sm xl:text-base">New</span>
                  </div> -->
                </div>
                
                <p class="text-gray-500 text-sm xl:text-base mb-4 line-clamp-2">
                  {{ item.description.en }}
                </p>
                
                <div class="flex items-center justify-between mb-6">
                  <div class="flex items-center text-gray-400 text-sm xl:text-base">
                    <svg class="w-4 h-4 xl:w-5 xl:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-bold text-orange-600 text-lg xl:text-xl">${{ item.price }}</span>
                  </div>
                </div>

                <button
                  class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-4 xl:py-5 px-6 rounded-2xl text-sm xl:text-base transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
                  @click="handleItemSelect(item)"
                >
                  Add to Order
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Detail Component -->
  <Detail 
    v-if="shadowDetail"
    :menuItem="selectedItem"
    :visible="shadowDetail"
    @close="shadowDetail = false"
  />
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

* {
  font-family: 'Inter', sans-serif;
}

/* Hide scrollbar while keeping scroll functionality */
.overflow-x-auto {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

.overflow-x-auto::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}

/* Line clamp utilities */
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Smooth transitions */
button {
  transition: all 0.2s ease;
}

button:active {
  transform: scale(0.98);
}

/* Focus states */
button:focus {
  outline: none;
}

input:focus {
  outline: none;
}

/* Custom breakpoints for better responsive design */
@media (min-width: 1536px) {
  .container-2xl {
    max-width: 1536px; 
  }
}
</style>
