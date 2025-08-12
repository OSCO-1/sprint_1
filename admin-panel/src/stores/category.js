import { ref } from 'vue';
import api from '../axios';

const categories = ref([]);
const isLoading = ref(false);
const error = ref(null);
const success = ref(null);

// Fetch categories
const getCategories = async () => {
  isLoading.value = true;
  error.value = null;
  success.value = null;

  try {
    const response = await api.get('categories');
    categories.value = response.data;
    success.value = 'Categories fetched successfully';
    console.log('Fetched categories:', categories.value);
  } catch (err) {
    error.value = err.response?.data?.message || 'Failed to fetch categories';
    console.error('Error fetching categories:', err);
  } finally {
    isLoading.value = false;
  }
};
// delete category
const deleteCategory = async (id) => {
  isLoading.value = true;
  error.value = null;
  success.value = null;

  try {
    await api.delete(`categories/${id}`);
    categories.value = categories.value.filter((category) => category.id !== id);
    success.value = 'Category deleted successfully';
  } catch (err) {
    error.value = err.response?.data?.message || 'Failed to delete category';
  } finally {
    isLoading.value = false;
  }
};
// Update category
const updateCategory = async (id, data) => {
  isLoading.value = true;
  error.value = null;
  success.value = null;

  try {
    const response = await api.put(`categories/${id}`, data);
    const index = categories.value.findIndex((category) => category.id === id);
    if (index !== -1) {
      categories.value[index] = response.data;
    }
    success.value = 'Category updated successfully';
  } catch (err) {
    error.value = err.response?.data?.message || 'Failed to update category';
  } finally {
    isLoading.value = false;
  }
};

export { categories, isLoading, error, success, getCategories, deleteCategory, updateCategory };
