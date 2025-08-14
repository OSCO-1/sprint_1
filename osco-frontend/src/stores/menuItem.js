// import api from "@/axios";
import api from "@/axios";
import { ref } from "vue";

const menuItems = ref([]);
const isLoading = ref(false);
const error = ref(null);
const success = ref(false);

// getMenuItems function to fetch menu items from the API
const getMenuItems = async () => {
    isLoading.value = true;
    try {
        const response = await api.get("items");
        console.log("getMenuItems response:", response.data);
        menuItems.value = Array.isArray(response.data) ? response.data : [];
        success.value = true;
    } catch (err) {
        error.value = err.response ? err.response.data : "Network Error";
        menuItems.value = [];
        console.error("getMenuItems error:", err);
    } finally {
        isLoading.value = false;
    }
};
// Filter menu items by category
const filterMenuItemsByCategory = async (categoryId) => {
    try {
        const response = await api.get(`items/filter/${categoryId}`);
        menuItems.value = response.data.data;
        success.value = true;
    } catch (error) {
        error.value = error.response ? error.response.data : "Network Error";
    }
}
// Search Items 
const searchItems = (searchTerm) => {
    if (!searchTerm) {
        return Array.isArray(menuItems.value) ? menuItems.value : [];
    }
    if (!Array.isArray(menuItems.value)) {
        console.warn("menuItems.value is not an array:", menuItems.value);
        return [];
    }
    return menuItems.value.filter(item =>
        (typeof item.name === 'string' ? item.name : item.name?.en || '').toLowerCase().includes(searchTerm.toLowerCase())
    );
};

const getMenuItemById = async (id) => {
    try {
        const response = await api.get(`menu-item/${id}`);
        return response.data.data;
    } catch (err) {
        error.value = err.response ? err.response.data : "Network Error";
        console.error("getMenuItemById error:", err);
        throw err;
    }
};

export {
    menuItems,
    isLoading,
    error,
    success,
    getMenuItems,
    filterMenuItemsByCategory,
    searchItems,
    getMenuItemById
};