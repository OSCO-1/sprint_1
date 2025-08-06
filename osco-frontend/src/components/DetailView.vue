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
              :src="pizzaImage" 
              :alt="menuItem.name" 
              class="w-full h-full object-cover absolute top-0 "
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
          <div class="flex-1 overflow-y-auto p-6 space-y-6 max-h-[236px]">
            <!-- Title and Description -->
            <div>
              <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ menuItem.name }}</h2>
              <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ menuItem.description }}</p>
            </div>
            
            <!-- Extras Section -->
            <div class="space-y-4">
              <h3 class="text-lg sm:text-xl font-bold text-gray-900">Would you like extras?</h3>
              <p class="text-gray-500 text-sm sm:text-base">Choose a maximum of 3 products</p>
              <div class="space-y-3">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Extra Cheese</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="extras.extraCheese"
                  />            
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Pepperoni</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="extras.pepperoni"
                  />            
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Mushrooms</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="extras.mushrooms"
                  />            
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Olives</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="extras.olives"
                  />            
                </div>
              </div>
            </div>

            <!-- Remove Ingredients Section -->
            <div class="space-y-4">
              <h3 class="text-lg sm:text-xl font-bold text-gray-900">Would you like to remove any ingredients?</h3>
              <p class="text-gray-500 text-sm sm:text-base">Select ingredients to remove from your order</p>
              <div class="space-y-3">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Cheese</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="removedIngredients.cheese"
                  />
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Onions</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="removedIngredients.onions"
                  />
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Tomato Sauce</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="removedIngredients.tomatoSauce"
                  />
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                  <span class="text-base sm:text-lg font-medium text-gray-800">Peppers</span>
                  <input
                    type="checkbox"
                    class="styled-checkbox"
                    v-model="removedIngredients.peppers"
                  />
                </div>
              </div>
            </div>
            
            <div class="flex-grow"></div>

            <!-- Quantity Selector -->
            <div class="flex items-center justify-center space-x-4 py-4">
              <button 
                @click="decreaseQuantity"
                :disabled="quantity <= 1"
                class="w-14 h-14 rounded-xl border-2 border-gray-200 flex items-center justify-center text-gray-600 hover:border-orange-500 hover:text-orange-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
              >
                <Minus class="w-6 h-6" />
              </button>
              
              <div class="w-20 h-14 bg-gray-50 rounded-xl flex items-center justify-center">
                <span class="text-2xl font-bold text-gray-900">{{ quantity }}</span>
              </div>
              
              <button 
                @click="increaseQuantity"
                class="w-14 h-14 rounded-xl border-2 border-gray-200 flex items-center justify-center text-gray-600 hover:border-orange-500 hover:text-orange-500 transition-all duration-200"
              >
                <Plus class="w-6 h-6" />
              </button>
            </div>
          </div>

          <!-- Action Button -->
          <div class="p-4 sm:p-6 bg-white border-t border-gray-100">
            <div class="flex space-x-3 pt-4">
              <button
                @click="addToCart"
                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-orange-500/20 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
              >
                <span>Add {{ quantity }} for ${{ totalPrice.toFixed(2) }}</span>
              </button>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </transition>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { X, Plus, Minus } from 'lucide-vue-next';
import pizzaImage from '@/assets/pizza.png';

const props = defineProps({
  menuItem: Object,
  visible: Boolean,
});

const emit = defineEmits(['close']);

const quantity = ref(1);
const specialInstructions = ref('');
const extras = reactive({
  extraCheese: false,
  pepperoni: false,
  mushrooms: false,
  olives: false,
});
const removedIngredients = reactive({
  cheese: false,
  onions: false,
  tomatoSauce: false,
  peppers: false,
});

const totalPrice = computed(() => {
  return props.menuItem.price * quantity.value;
});

const increaseQuantity = () => {
  quantity.value++;
};

const decreaseQuantity = () => {
  if (quantity.value > 1) {
    quantity.value--;
  }
};

const addToCart = () => {
  console.log('Adding to cart:', {
    item: props.menuItem,
    quantity: quantity.value,
    extras: extras,
    removedIngredients: removedIngredients,
    specialInstructions: specialInstructions.value,
    totalPrice: totalPrice.value
  });
  emit('close');
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