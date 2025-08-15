import { ref } from 'vue';
import api from '../axios';

const categories = ref([]);
const isLoading = ref(false);
const error = ref(null);
const success = ref(null);

// Fetch categories with retry logic
const getCategories = async (retryCount = 0) => {
  isLoading.value = true;
  error.value = null;
  success.value = null;

  try {
    const response = await api.get('categories');
    categories.value = response.data;
    success.value = 'Categories fetched successfully';
    console.log('Fetched categories:', categories.value);
  } catch (err) {
    // Retry logic for timeout errors
    if ((err.code === 'ECONNABORTED' || err.message.includes('timeout')) && retryCount < 2) {
      console.log(`Retrying categories fetch... Attempt ${retryCount + 1}/3`);
      await new Promise(resolve => setTimeout(resolve, 2000)); // Wait 2 seconds
      return getCategories(retryCount + 1);
    }

    const errorMessage = err.code === 'ECONNABORTED'
      ? 'Server timeout - please check your connection and try again'
      : err.response?.data?.message || 'Failed to fetch categories';

    error.value = errorMessage;
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
    console.log('Updating category with data:', { id, data });

    // Log validation errors for debugging
    console.log('Validation check:');
    console.log('- name:', data.name);
    console.log('- description:', data.description);
    console.log('- image_url:', data.image_url);
    console.log('- display_order:', data.display_order);

    // Categories use JSON data, not FormData, so regular PUT works fine
    const response = await api.put(`categories/${id}`, data);

    console.log('Category update response:', response.data);

    const index = categories.value.findIndex((category) => category.id == id);
    if (index !== -1) {
      categories.value[index] = response.data;
      console.log('Updated category in local store:', categories.value[index]);
    } else {
      console.warn('Category not found in local store, refreshing list');
    }

    // Refresh the entire list to ensure consistency
    await getCategories();
    success.value = 'Category updated successfully';

    return response.data;
  } catch (err) {
    console.error('Error updating category:', err);
    console.error('Error response:', err.response?.data);
    console.error('Validation errors:', err.response?.data?.errors);

    let errorMessage = 'Failed to update category';
    if (err.response?.data?.errors) {
      const validationErrors = Object.values(err.response.data.errors).flat();
      errorMessage = validationErrors.join(', ');
      error.value = errorMessage;
    } else if (err.response?.data?.message) {
      errorMessage = err.response.data.message;
      error.value = errorMessage;
    } else {
      error.value = errorMessage;
    }
    
    throw new Error(errorMessage);
  } finally {
    isLoading.value = false;
  }
};
// Add new category
const addCategory = async (categoryData) => {
  isLoading.value = true;
  error.value = null;
  success.value = null;

  try {
    let config = {};
    // If FormData, set correct headers
    if (categoryData instanceof FormData) {
      config.headers = { 'Content-Type': 'multipart/form-data' };
    }
    const response = await api.post('categories', categoryData, config);
    await getCategories();
    success.value = 'Category added successfully';
    return response.data;
  } catch (err) {
    console.error('Category creation error:', err);
    console.error('Error response:', err.response?.data);
    console.error('Error status:', err.response?.status);

    // Handle validation errors
    if (err.response?.data?.errors) {
      const validationErrors = Object.values(err.response.data.errors).flat();
      error.value = validationErrors.join(', ');
    } else {
      error.value = err.response?.data?.message || err.response?.data?.error || 'Failed to add category';
    }

    // Re-throw the error so the component can handle it
    throw err;
  } finally {
    isLoading.value = false;
  }
};

// Reorder categories
const reorderCategories = async (orderedIds) => {
  isLoading.value = true;
  error.value = null;
  success.value = null;

  try {
    console.log('Reordering categories with IDs:', orderedIds);
    console.log('Current categories:', categories.value.map(c => ({ id: c.id, name: c.name?.en, order: c.display_order })));

    // Validate that all IDs exist in current categories
    const existingIds = categories.value.map(c => c.id);
    const invalidIds = orderedIds.filter(id => !existingIds.includes(id));
    
    if (invalidIds.length > 0) {
      throw new Error(`Invalid category IDs: ${invalidIds.join(', ')}`);
    }

    // Try test endpoint first to verify connectivity
    console.log('Testing basic connectivity...');
    try {
      const testResponse = await api.post('categories/test-reorder', {
        ordered_ids: orderedIds
      });
      console.log('Test endpoint response:', testResponse.data);
    } catch (testErr) {
      console.error('Test endpoint also failed:', testErr.response?.data);
    }
    
    // Try different endpoint formats to debug the 500 error
    console.log('Making request to: categories/reorder');
    console.log('Payload:', { ordered_ids: orderedIds });
    
    const response = await api.post('categories/reorder', {
      ordered_ids: orderedIds
    });

    console.log('Reorder response:', response.data);

    // Refresh categories to get updated order
    await getCategories();
    success.value = 'Categories reordered successfully';

    return response.data;
  } catch (err) {
    console.error('Category reorder error:', err);
    console.error('Error response:', err.response?.data);
    console.error('Error response text:', JSON.stringify(err.response?.data, null, 2));
    console.error('Error status:', err.response?.status);
    console.error('Error headers:', err.response?.headers);
    console.error('Request config:', err.config);
    console.error('Request data:', err.config?.data);
    console.error('Full error:', err);

    let errorMessage = 'Failed to reorder categories';
    
    if (err.response?.data?.errors) {
      console.error('Validation errors:', err.response.data.errors);
      errorMessage = Object.values(err.response.data.errors).flat().join(', ');
    } else if (err.response?.data?.message) {
      errorMessage = err.response.data.message;
    } else if (err.message) {
      errorMessage = err.message;
    }

    error.value = errorMessage;

    // Re-throw the error so the component can handle it
    throw err;
  } finally {
    isLoading.value = false;
  }
};

export { categories, isLoading, error, success, getCategories, deleteCategory, updateCategory, addCategory, reorderCategories };
