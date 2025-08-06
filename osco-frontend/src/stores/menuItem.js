// import api from "@/axios";
import api from "@/axios";
import { ref } from "vue";

const menuItems = ref([]);
const isLoading = ref(false);
const error = ref(null);
const success = ref(false);

// getMenuItems function to fetch menu items from the API
const getMenuItems = async () =>{
    isLoading.value = true;
    try {
        const response = await api.get("menu-item/");
        menuItems.value = response.data.data;
        success.value = true;
    } catch (err) {
        error.value = err.response ? err.response.data : "Network Error";
    } finally {
        isLoading.value = false;
    }
}
// Filter menu items by category
const filterMenuItemsByCategory = async (categoryId) => {
    try {
        const response = await api.get(`menu-item/filter/${categoryId}`);
        menuItems.value = response.data.data;
        success.value = true;
    } catch (error) {
        error.value = error.response ? error.response.data : "Network Error";
    }
}
// Search Items 
const searchItems = (searchTerm) => {
    if (!searchTerm) {
        return menuItems.value; // Return all items if search term is empty
    }
    return menuItems.value.filter(item =>
        item.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
};
// get menu item by id
const getMenuItemById = async (id) => {
    try {
        const response = await api.get(`menu-item/${id}`);
        return response.data.data;
    }
    catch (err) {
        error.value = err.response ? err.response.data : "Network Error";
        throw err; // Re-throw the error for further handling if needed
    }
}

// Exporting the state and functions
export{
    menuItems,
    isLoading,
    error,
    success,
    getMenuItems,
    filterMenuItemsByCategory,
    searchItems,
    getMenuItemById
}
