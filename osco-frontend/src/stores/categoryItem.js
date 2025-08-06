import api from '@/axios';
import { ref } from 'vue';

const categoryItems = ref([]);
const isLoading = ref(false);
const error = ref(null);
const success = ref(false);

// getCategoryItems function to fetch category items from the API
const getCategoryItems = async () => {
  isLoading.value = true;
  try {
    const response = await api.get('menu-category');
    categoryItems.value = response.data.data;
    success.value = true;
  } catch (err) {
    error.value = err.response ? err.response.data : 'Network Error';
  } finally {
    isLoading.value = false;
  }
};

// Exporting the state and functions
export { categoryItems, isLoading, error, success, getCategoryItems };