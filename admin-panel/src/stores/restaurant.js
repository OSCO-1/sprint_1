import api from '../axios';
import { ref } from 'vue';

const restaurantInfo = ref({});
const isLoading = ref(false);
const error = ref(null);
const success = ref(false);

const getRestaurantInfo = async () => {
  isLoading.value = true;
  try {
    const response = await api.get(`restaurant`);
    restaurantInfo.value = response.data; // no array, keep object
    success.value = true;
  } catch (err) {
    console.error('Error fetching restaurant info:', err);
    error.value = err;
    restaurantInfo.value = {};
  } finally {
    isLoading.value = false;
  }
};

const updateBasicInfo = async (updatedInfo) => {
  isLoading.value = true;
  try {
    const response = await api.put(`restaurant/basic-info`, updatedInfo);
    restaurantInfo.value = response.data;
    success.value = true;
  } catch (err) {
    console.error('Error updating restaurant info:', err);
    error.value = err;
  } finally {
    isLoading.value = false;
  }
};

export {
  restaurantInfo,
  isLoading,
  error,
  success,
  getRestaurantInfo,
  updateBasicInfo
};
