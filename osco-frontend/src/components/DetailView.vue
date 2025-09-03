<template>
  <!-- Backdrop -->
  <transition name="backdrop">
    <div 
      v-if="visible" 
      class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
      @click="handleBackdropClick"
    >
      <!-- Modal Content -->
      <transition name="slide-up">
        <div 
          v-if="visible"
          class="bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-hidden flex flex-col"
          @click.stop
        >
          <!-- Header Image Section -->
          <div class="relative bg-red-500 h-64 sm:h-72 rounded-t-3xl sm:rounded-t-3xl overflow-hidden">
            <img
              :src="`https://oscoapi-hjtj1.sevalla.app/storage/${menuItem.image_url}`" 
              :alt="menuItem.name" 
              class="w-full h-full object-cover absolute top-0"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>

            <!-- Close Button -->
            <button 
              @click="$emit('close')" 
              class="absolute top-4 left-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
            >
              <X class="w-5 h-5" />
            </button>
          </div>
          
          <!-- Content Area -->
          <div 
            ref="contentArea"
            class="flex-1 overflow-y-auto p-6 space-y-6 max-h-[236px]"
            @scroll="handleScroll"
          >
            <!-- Title and Description -->
          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ getLocalizedText(menuItem.name) }}</h2>
              <h2 class="text-2xl sm:text-3xl font-bold text-orange-600 mb-2">{{ menuItem.base_price }} DH</h2>
              <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ getLocalizedText(menuItem.description) }}</p>
            </div>
          </div>
            
            
            <div class="flex-grow"></div>
          </div>


        </div>
      </transition>
    </div>
  </transition>
</template>

<script setup>
import { ref } from 'vue';
import { X } from 'lucide-vue-next';
import { getLocalizedText } from '@/stores/language';

// eslint-disable-next-line no-unused-vars
const props = defineProps({
  menuItem: Object,
  visible: Boolean,
});

const emit = defineEmits(['close']);

const scrollY = ref(0);
const contentArea = ref(null);

// Handle scroll events for image animation
const handleScroll = (event) => {
  if (event.target) {
    scrollY.value = event.target.scrollTop;
  }
};

const handleBackdropClick = () => {
  emit('close');
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

/* Backdrop transitions */
.backdrop-enter-active,
.backdrop-leave-active {
  transition: all 0.3s ease;
}

.backdrop-enter-from,
.backdrop-leave-to {
  opacity: 0;
}

/* Modal slide transitions */
.slide-up-enter-active,
.slide-up-leave-active {
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.slide-up-enter-from,
.slide-up-leave-to {
  transform: translateY(100%);
  opacity: 0;
}

@media (min-width: 640px) {
  .slide-up-enter-from,
  .slide-up-leave-to {
    transform: translateY(50px) scale(0.95);
  }
}

/* Typography */
* {
  font-family: 'Inter', sans-serif;
}

/* Custom styled checkbox */
.styled-checkbox {
  appearance: none;
  width: 32px;
  height: 32px;
  border-radius: 0.5rem; /* rounded-lg */
  border: 2px solid #d1d5db; /* gray-300 */
  background-color: white;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.styled-checkbox:checked {
  background-color: #f97316; /* orange-500 */
  border-color: #f97316;
}

.styled-checkbox:checked::before {
  content: '';
  width: 10px;
  height: 18px;
  border: solid white;
  border-width: 0 3px 3px 0;
  transform: rotate(45deg);
  position: absolute;
}
</style>