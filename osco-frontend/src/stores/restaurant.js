import api from '../axios';
import { ref } from 'vue';

const restaurantInfos = ref([]);
const isLoading = ref(false);
const error = ref(null);
const success = ref(false);

// Fetch restaurant information
const getRestaurantInfo = async () => {
  isLoading.value = true;
  try {
    const response = await api.get('restaurant');
    restaurantInfos.value = [response.data];
    success.value = true;
  } catch (error) {
    console.error('Error fetching restaurant info:', error);
    restaurantInfos.value = [];
  } finally {
    isLoading.value = false;
  }
}


export {
  restaurantInfos,
  isLoading,
  error,
  success,
  getRestaurantInfo
}
