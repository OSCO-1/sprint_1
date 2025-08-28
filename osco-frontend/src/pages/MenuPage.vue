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
    <!-- Mobile Header -->
    <div class="bg-white px-4 py-3 shadow-sm">

      <!-- Navigation Header -->
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-4">
          <button 
            @click="goBack"
            class="p-2 hover:bg-gray-100 rounded-lg transition-colors"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <div class="flex space-x-4">
            <button class="text-black font-medium border-b-2 border-orange-500 pb-1">OSCO</button>
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
      <!-- Search Bar -->
      <div class="mb-4">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <Search class="h-5 w-5 text-gray-400" />
          </div>
          <input
            v-model="searchTerm"
            type="text"
            placeholder="Search for food..."
            class="block w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:bg-white text-sm"
          />
          <div v-if="searchTerm" class="absolute inset-y-0 right-0 pr-4 flex items-center">
            <button 
              @click="searchTerm = ''"
              class="text-gray-400 hover:text-gray-600 transition-colors"
            >
              <X class="h-5 w-5" />
            </button>
          </div>
        </div>
      </div>

      <!-- Categories -->
      <div v-if="categoryItems && categoryItems.length > 0" class="flex space-x-6 overflow-x-auto pb-2">
        <div v-for="category in categoryItems || []" :key="category.id" class="flex flex-col items-center flex-shrink-0">
          <button 
            @click="handleCategoryFilter(category.id)"
            :class="[
              'w-16 h-16 rounded-2xl mb-2 flex items-center justify-center overflow-hidden transition-all duration-200',
              selectedCategory === category.id ? 'bg-orange-500 shadow-lg' : 'bg-orange-100'
            ]"
          >
            <div v-if="category.name === 'Promotions'" class="text-white text-xl font-bold">%</div>
            <img 
              v-else 
              :src="`https://oscoapi-hjtj1.sevalla.app/storage/${category.image_url}`" 
              :alt="category.name.en || 'Category'" 
              class="w-12 h-12 object-cover rounded-xl"
              @error="handleImageError"
              @load="handleImageLoad"
            >
          </button>
          <span class="text-xs text-gray-600 font-medium text-center">{{ category.name.en }}</span>
        </div>
      </div>

      <!-- Clear Filter Button -->
      <div v-if="selectedCategory" class="mt-4">
        <button 
          @click="showAllItems"
          class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-full px-6 py-2.5 hover:from-orange-600 hover:to-red-600 text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
          title="Show All Items"
        >
          <X class="h-4 w-4 mr-2" />
          Clear Filter
        </button>
      </div>

      <!-- Error Message -->
      <div v-if="error" class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-center text-sm">
        {{ error }}
      </div>

      <!-- Loading State -->
      <div v-if="isLoading" class="text-center py-8">
        <div class="inline-flex items-center space-x-2">
          <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-orange-500"></div>
          <p class="text-gray-500 text-sm">Loading categories...</p>
        </div>
      </div>
    </div>

    <div class="px-4 py-6">
      <!-- No Results Message -->
      <div v-if="searchTerm && filteredMenuItems && filteredMenuItems.length === 0" class="text-center py-12">
        <div class="text-gray-400 mb-4">
          <Search class="mx-auto h-12 w-12" />
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No items found</h3>
        <p class="text-gray-500">Try searching with different keywords.</p>
      </div>

      <!-- Menu Items Grid -->
      <div v-else class="grid grid-cols-2 gap-4">
        <div
          v-for="item in filteredMenuItems || []"
          :key="item.id"
          class="bg-white rounded-2xl overflow-hidden shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-200"
          @click="handleItemSelect(item)"
          data-aos="fade-up"
        >
          <!-- Image -->
          <div class="relative h-32 bg-gray-100 overflow-hidden">
            <img 
              :src="`https://oscoapi-hjtj1.sevalla.app/storage/${item.image_url}`"
              :alt="item.name.en" 
              class="w-full h-full object-cover"
              @error="$event.target.src = 'https://via.placeholder.com/200x128/f3f4f6/9ca3af?text=No+Image'"
            >
          </div>
          
          <!-- Content -->
          <div class="p-3">
            <h3 class="font-bold text-black text-sm mb-1 line-clamp-1">{{ item.name.en }}</h3>
            <p class="text-gray-500 text-xs mb-2 line-clamp-1">{{ item.description.en }}</p>
            
            <!-- Price and Add Button -->
            <div class="flex items-center justify-between">
              <span class="font-bold text-orange-600 text-sm">${{ item.base_price }}</span>
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
