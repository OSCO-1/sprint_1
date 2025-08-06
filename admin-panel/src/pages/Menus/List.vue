<template>
  <div>
    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <card class="card-chart">
          <template slot="header">
            <div class="row">
              <div class="col-sm-6 text-left">
                <h2 class="card-title">Menu Items</h2>
                <p class="card-category">
                  <i class="tim-icons icon-app text-primary"></i>
                  Manage your restaurant menu items
                </p>
              </div>
              <div class="col-sm-6">
                <div class="btn-group-toggle float-right" data-toggle="buttons">
                  <router-link to="/menus/add" class="btn btn-sm btn-primary btn-simple">
                    <i class="tim-icons icon-simple-add"></i>
                    Add New Menu Item
                  </router-link>
                </div>
              </div>
            </div>
          </template>
        </card>
      </div>
    </div>

    <!-- Search and Filter -->
    <div class="row">
      <div class="col-12">
        <card>
          <div class="row">
            <div class="col-md-4">
              <base-input
                placeholder="Search menu items..."
                v-model="searchQuery"
                @input="filterMenuItems"
              >
                <template slot="prepend">
                  <span class="input-group-text">
                    <i class="tim-icons icon-zoom-split"></i>
                  </span>
                </template>
              </base-input>
            </div>
            <div class="col-md-3">
              <select 
                class="form-control" 
                v-model="selectedCategory"
                @change="filterMenuItems"
              >
                <option value="">All Categories</option>
                <option v-for="category in categories" :key="category" :value="category">
                  {{ category }}
                </option>
              </select>
            </div>
            <div class="col-md-2">
              <select 
                class="form-control" 
                v-model="priceRange"
                @change="filterMenuItems"
              >
                <option value="">All Prices</option>
                <option value="0-10">$0 - $10</option>
                <option value="10-20">$10 - $20</option>
                <option value="20-50">$20 - $50</option>
                <option value="50+">$50+</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="d-flex justify-content-end align-items-center">
                <span class="text-muted mr-2">{{ filteredMenuItems.length }} items found</span>
                <base-button
                  type="info"
                  size="sm"
                  @click="refreshMenuItems"
                  :disabled="isLoading"
                >
                  <i class="tim-icons icon-refresh-01" :class="{ 'fa-spin': isLoading }"></i>
                  Refresh
                </base-button>
              </div>
            </div>
          </div>
        </card>
      </div>
    </div>

    <!-- Menu Items Table -->
    <div class="row" v-if="!isLoading">
      <div class="col-12">
        <card>
          <!-- Desktop Table View -->
          <div class="table-responsive d-none d-lg-block">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 80px;">Image</th>
                  <th style="width: 180px;">Name</th>
                  <th style="width: 120px;">Category</th>
                  <th style="width: 100px;">Price</th>
                  <th>Description</th>
                  <th style="width: 80px;">Rating</th>
                  <th style="width: 120px;">Created</th>
                  <th style="width: 180px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="menuItem in paginatedMenuItems" :key="menuItem.id">
                  <td>
                    <img 
                      :src="menuItem.image || '/img/placeholder-food.jpg'" 
                      :alt="menuItem.name"
                      class="table-image"
                      @error="handleImageError"
                    />
                  </td>
                  <td>
                    <strong>{{ menuItem.name }}</strong>
                  </td>
                  <td>
                    <span class="badge badge-primary">{{ menuItem.categoryName }}</span>
                  </td>
                  <td>
                    <span class="text-success font-weight-bold">${{ menuItem.price.toFixed(2) }}</span>
                  </td>
                  <td>
                    <span class="text-muted">{{ truncateText(menuItem.description, 50) }}</span>
                  </td>
                  <td>
                    <div class="rating">
                      <i class="tim-icons icon-heart-2 text-warning"></i>
                      <span class="ml-1">{{ menuItem.rating || 'N/A' }}</span>
                    </div>
                  </td>
                  <td>
                    <small class="text-muted">
                      {{ formatDate(menuItem.createdAt) }}
                    </small>
                  </td>
                  <td>
                    <div class="btn-group-vertical btn-group-sm" role="group">
                      <base-button
                        type="info"
                        size="sm"
                        @click="viewDetails(menuItem)"
                        title="View Details"
                        class="mb-1"
                      >
                        <i class="tim-icons icon-zoom-split"></i>
                      </base-button>
                      <base-button
                        type="warning"
                        size="sm"
                        @click="editMenuItem(menuItem)"
                        title="Edit Menu Item"
                        class="mb-1"
                      >
                        <i class="tim-icons icon-pencil"></i>
                      </base-button>
                      <base-button
                        type="danger"
                        size="sm"
                        @click="confirmDelete(menuItem)"
                        title="Delete Menu Item"
                      >
                        <i class="tim-icons icon-simple-remove"></i>
                      </base-button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Mobile Card View -->
          <div class="d-lg-none">
            <div class="mobile-card" v-for="menuItem in paginatedMenuItems" :key="menuItem.id">
              <div class="row no-gutters">
                <div class="col-4">
                  <img 
                    :src="menuItem.image || '/img/placeholder-food.jpg'" 
                    :alt="menuItem.name"
                    class="mobile-image"
                    @error="handleImageError"
                  />
                </div>
                <div class="col-8">
                  <div class="mobile-card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                      <h6 class="mobile-card-title mb-0">{{ menuItem.name }}</h6>
                      <span class="text-success font-weight-bold">${{ menuItem.price.toFixed(2) }}</span>
                    </div>
                    <div class="mb-2">
                      <span class="badge badge-primary badge-sm mr-2">{{ menuItem.categoryName }}</span>
                      <span class="rating-mobile">
                        <i class="tim-icons icon-heart-2 text-warning"></i>
                        <span class="ml-1">{{ menuItem.rating || 'N/A' }}</span>
                      </span>
                    </div>
                    <p class="mobile-card-text">{{ truncateText(menuItem.description, 80) }}</p>
                    <div class="mobile-card-meta mb-2">
                      <small class="text-muted">
                        {{ formatDate(menuItem.createdAt) }}
                      </small>
                    </div>
                    <div class="mobile-actions">
                      <base-button
                        type="info"
                        size="sm"
                        @click="viewDetails(menuItem)"
                        title="View Details"
                        class="mr-1"
                      >
                        <i class="tim-icons icon-zoom-split"></i>
                      </base-button>
                      <base-button
                        type="warning"
                        size="sm"
                        @click="editMenuItem(menuItem)"
                        title="Edit Menu Item"
                        class="mr-1"
                      >
                        <i class="tim-icons icon-pencil"></i>
                      </base-button>
                      <base-button
                        type="danger"
                        size="sm"
                        @click="confirmDelete(menuItem)"
                        title="Delete Menu Item"
                      >
                        <i class="tim-icons icon-simple-remove"></i>
                      </base-button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </card>
      </div>
    </div>

    <!-- Loading State -->
    <div class="row" v-if="isLoading">
      <div class="col-12">
        <card>
          <div class="text-center py-5">
            <i class="fa fa-spinner fa-spin fa-3x text-primary mb-3"></i>
            <h4>Loading menu items...</h4>
          </div>
        </card>
      </div>
    </div>

    <!-- Empty State -->
    <div class="row" v-if="!isLoading && filteredMenuItems.length === 0">
      <div class="col-12">
        <card>
          <div class="text-center py-5">
            <i class="tim-icons icon-app fa-3x text-muted mb-3"></i>
            <h4>No menu items found</h4>
            <p class="text-muted">{{ searchQuery || selectedCategory || priceRange ? 'Try adjusting your search criteria' : 'Start by creating your first menu item' }}</p>
            <router-link to="/menus/add" class="btn btn-primary" v-if="!searchQuery && !selectedCategory && !priceRange">
              <i class="tim-icons icon-simple-add"></i>
              Add New Menu Item
            </router-link>
          </div>
        </card>
      </div>
    </div>

    <!-- Pagination -->
    <div class="row" v-if="totalPages > 1">
      <div class="col-12">
        <card>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <small class="text-muted">
                Showing {{ (currentPage - 1) * itemsPerPage + 1 }} to {{ Math.min(currentPage * itemsPerPage, filteredMenuItems.length) }} of {{ filteredMenuItems.length }} menu items
              </small>
            </div>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                  <a class="page-link" @click="changePage(currentPage - 1)" href="#">
                    <i class="tim-icons icon-double-left"></i>
                  </a>
                </li>
                <li 
                  class="page-item" 
                  v-for="page in visiblePages" 
                  :key="page"
                  :class="{ active: page === currentPage }"
                >
                  <a class="page-link" @click="changePage(page)" href="#">{{ page }}</a>
                </li>
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                  <a class="page-link" @click="changePage(currentPage + 1)" href="#">
                    <i class="tim-icons icon-double-right"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </card>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template slot="header">
        <h4 class="modal-title text-danger">
          <i class="tim-icons icon-alert-circle-exc"></i>
          Confirm Delete
        </h4>
      </template>
      <div v-if="menuItemToDelete">
        <p>Are you sure you want to delete the menu item <strong>"{{ menuItemToDelete.name }}"</strong>?</p>
        <p class="text-muted">This action cannot be undone.</p>
      </div>
      <template slot="footer">
        <base-button type="secondary" @click="showDeleteModal = false">Cancel</base-button>
        <base-button 
          type="danger" 
          @click="deleteMenuItem" 
          :disabled="isDeleting"
        >
          <i class="fa fa-spinner fa-spin" v-if="isDeleting"></i>
          <i class="tim-icons icon-simple-remove" v-else></i>
          {{ isDeleting ? 'Deleting...' : 'Delete' }}
        </base-button>
      </template>
    </modal>

    <!-- Menu Item Details Modal -->
    <modal :show="showDetailsModal" @close="showDetailsModal = false" size="lg">
      <template slot="header">
        <h4 class="modal-title">
          <i class="tim-icons icon-zoom-split text-info"></i>
          Menu Item Details
        </h4>
      </template>
      <div v-if="selectedMenuItem" class="menu-item-details">
        <div class="row">
          <div class="col-md-6">
            <img 
              :src="selectedMenuItem.image || '/img/placeholder-food.jpg'" 
              :alt="selectedMenuItem.name"
              class="img-fluid rounded"
            />
          </div>
          <div class="col-md-6">
            <h3>{{ selectedMenuItem.name }}</h3>
            <p class="text-primary h4">${{ selectedMenuItem.price.toFixed(2) }}</p>
            <span class="badge badge-primary mb-3">{{ selectedMenuItem.categoryName }}</span>
            <p class="text-muted">{{ selectedMenuItem.description }}</p>
            <hr>
            <div class="menu-item-info">
              <div class="info-item">
                <strong>Rating:</strong>
                <span class="ml-2">{{ selectedMenuItem.rating || 'N/A' }} ⭐</span>
              </div>
              <div class="info-item">
                <strong>Created:</strong>
                <span class="ml-2">{{ formatDate(selectedMenuItem.createdAt) }}</span>
              </div>
              <div class="info-item">
                <strong>Last Updated:</strong>
                <span class="ml-2">{{ formatDate(selectedMenuItem.updatedAt) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <template slot="footer">
        <base-button type="secondary" @click="showDetailsModal = false">Close</base-button>
        <base-button 
          type="warning" 
          @click="editMenuItem(selectedMenuItem)"
          v-if="selectedMenuItem"
        >
          <i class="tim-icons icon-pencil"></i>
          Edit Menu Item
        </base-button>
      </template>
    </modal>
  </div>
</template>

<script>
import { BaseInput, BaseButton, Card, Modal } from '@/components';

export default {
  name: 'MenusList',
  components: {
    BaseInput,
    BaseButton,
    Card,
    Modal
  },
  data() {
    return {
      menuItems: [],
      filteredMenuItems: [],
      categories: [],
      searchQuery: '',
      selectedCategory: '',
      priceRange: '',
      isLoading: true,
      isDeleting: false,
      showDeleteModal: false,
      showDetailsModal: false,
      menuItemToDelete: null,
      selectedMenuItem: null,
      currentPage: 1,
      itemsPerPage: 10
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredMenuItems.length / this.itemsPerPage);
    },
    paginatedMenuItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredMenuItems.slice(start, end);
    },
    visiblePages() {
      const pages = [];
      const maxVisible = 5;
      let start = Math.max(1, this.currentPage - Math.floor(maxVisible / 2));
      let end = Math.min(this.totalPages, start + maxVisible - 1);
      
      if (end - start < maxVisible - 1) {
        start = Math.max(1, end - maxVisible + 1);
      }
      
      for (let i = start; i <= end; i++) {
        pages.push(i);
      }
      return pages;
    }
  },
  methods: {
    async loadMenuItems() {
      this.isLoading = true;
      try {
        // Simulate API call - replace with actual API endpoint
        const response = await this.fetchMenuItems();
        this.menuItems = response;
        this.filteredMenuItems = [...this.menuItems];
        this.extractCategories();
      } catch (error) {
        console.error('Error loading menu items:', error);
        this.showErrorNotification('Failed to load menu items');
      } finally {
        this.isLoading = false;
      }
    },
    
    async fetchMenuItems() {
      // Simulate API call with sample data
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve([
            {
              id: 1,
              name: 'Grilled Chicken Caesar Salad',
              categoryName: 'Salads',
              price: 14.99,
              description: 'Fresh romaine lettuce, grilled chicken breast, parmesan cheese, croutons, and our signature Caesar dressing',
              image: 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400',
              rating: 4.5,
              createdAt: new Date('2024-01-15'),
              updatedAt: new Date('2024-01-20')
            },
            {
              id: 2,
              name: 'Beef Burger Deluxe',
              categoryName: 'Main Course',
              price: 18.50,
              description: 'Juicy beef patty with lettuce, tomato, onion, pickles, and special sauce on a brioche bun. Served with fries.',
              image: 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400',
              rating: 4.8,
              createdAt: new Date('2024-01-16'),
              updatedAt: new Date('2024-01-22')
            },
            {
              id: 3,
              name: 'Chocolate Lava Cake',
              categoryName: 'Desserts',
              price: 8.99,
              description: 'Warm chocolate cake with a molten chocolate center, served with vanilla ice cream',
              image: 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=400',
              rating: 4.9,
              createdAt: new Date('2024-01-17'),
              updatedAt: new Date('2024-01-21')
            },
            {
              id: 4,
              name: 'Fresh Fruit Smoothie',
              categoryName: 'Beverages',
              price: 6.50,
              description: 'Blend of fresh seasonal fruits with yogurt and honey',
              image: 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400',
              rating: 4.3,
              createdAt: new Date('2024-01-18'),
              updatedAt: new Date('2024-01-23')
            },
            {
              id: 5,
              name: 'Crispy Chicken Wings',
              categoryName: 'Appetizers',
              price: 12.99,
              description: 'Crispy chicken wings tossed in your choice of buffalo, BBQ, or honey garlic sauce',
              image: 'https://images.unsplash.com/photo-1541014741259-de529411b96a?w=400',
              rating: 4.6,
              createdAt: new Date('2024-01-19'),
              updatedAt: new Date('2024-01-24')
            },
            {
              id: 6,
              name: 'Tomato Basil Soup',
              categoryName: 'Soups',
              price: 7.99,
              description: 'Creamy tomato soup with fresh basil, served with garlic bread',
              image: 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400',
              rating: 4.4,
              createdAt: new Date('2024-01-20'),
              updatedAt: new Date('2024-01-25')
            },
            {
              id: 7,
              name: 'Salmon Teriyaki',
              categoryName: 'Main Course',
              price: 24.99,
              description: 'Grilled salmon glazed with teriyaki sauce, served with steamed vegetables and jasmine rice',
              image: 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400',
              rating: 4.7,
              createdAt: new Date('2024-01-21'),
              updatedAt: new Date('2024-01-26')
            },
            {
              id: 8,
              name: 'Iced Coffee',
              categoryName: 'Beverages',
              price: 4.50,
              description: 'Cold brew coffee served over ice with your choice of milk',
              image: 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400',
              rating: 4.2,
              createdAt: new Date('2024-01-22'),
              updatedAt: new Date('2024-01-27')
            }
          ]);
        }, 1000);
      });
    },

    extractCategories() {
      const categories = [...new Set(this.menuItems.map(item => item.categoryName))];
      this.categories = categories.sort();
    },

    filterMenuItems() {
      let filtered = [...this.menuItems];

      // Filter by search query
      if (this.searchQuery.trim()) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(item => 
          item.name.toLowerCase().includes(query) ||
          item.description.toLowerCase().includes(query) ||
          item.categoryName.toLowerCase().includes(query)
        );
      }

      // Filter by category
      if (this.selectedCategory) {
        filtered = filtered.filter(item => item.categoryName === this.selectedCategory);
      }

      // Filter by price range
      if (this.priceRange) {
        filtered = filtered.filter(item => {
          const price = item.price;
          switch (this.priceRange) {
            case '0-10':
              return price >= 0 && price <= 10;
            case '10-20':
              return price > 10 && price <= 20;
            case '20-50':
              return price > 20 && price <= 50;
            case '50+':
              return price > 50;
            default:
              return true;
          }
        });
      }

      this.filteredMenuItems = filtered;
      this.currentPage = 1; // Reset to first page when filtering
    },

    refreshMenuItems() {
      this.loadMenuItems();
    },

    viewDetails(menuItem) {
      this.selectedMenuItem = menuItem;
      this.showDetailsModal = true;
    },

    editMenuItem(menuItem) {
      // Navigate to edit page - you can implement this route
      this.$router.push(`/menus/edit/${menuItem.id}`);
    },

    confirmDelete(menuItem) {
      this.menuItemToDelete = menuItem;
      this.showDeleteModal = true;
    },

    async deleteMenuItem() {
      if (!this.menuItemToDelete) return;
      
      this.isDeleting = true;
      try {
        // Simulate API call - replace with actual delete endpoint
        await this.deleteMenuItemAPI(this.menuItemToDelete.id);
        
        // Remove from local array
        this.menuItems = this.menuItems.filter(item => item.id !== this.menuItemToDelete.id);
        this.filterMenuItems(); // Refresh filtered list
        
        this.showSuccessNotification('Menu item deleted successfully!');
        this.showDeleteModal = false;
        this.menuItemToDelete = null;
      } catch (error) {
        console.error('Error deleting menu item:', error);
        this.showErrorNotification('Failed to delete menu item');
      } finally {
        this.isDeleting = false;
      }
    },

    async deleteMenuItemAPI(menuItemId) {
      // Simulate API call
      return new Promise((resolve, reject) => {
        setTimeout(() => {
          // Simulate random success/failure
          if (Math.random() > 0.1) {
            resolve();
          } else {
            reject(new Error('Simulated API error'));
          }
        }, 1000);
      });
    },

    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },

    truncateText(text, maxLength) {
      if (!text) return '';
      return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    },

    formatDate(date) {
      if (!date) return 'N/A';
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      });
    },

    handleImageError(event) {
      event.target.src = '/img/placeholder-food.jpg';
    },

    showSuccessNotification(message) {
      this.$notify({
        type: 'success',
        icon: 'tim-icons icon-check-2',
        message: message
      });
    },

    showErrorNotification(message) {
      this.$notify({
        type: 'danger',
        icon: 'tim-icons icon-simple-remove',
        message: message
      });
    }
  },

  mounted() {
    this.loadMenuItems();
  }
};
</script>

<style scoped>
.table-image {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.table-responsive {
  border-radius: 8px;
  overflow: hidden;
}

.table {
  margin-bottom: 0;
}

.table th {
  border-top: none;
  font-weight: 600;
  color: #525f7f;
  background-color: #f8f9fe;
  padding: 1rem 0.75rem;
}

.table td {
  padding: 1rem 0.75rem;
  vertical-align: middle;
}

.btn-group .btn {
  margin-right: 0.25rem;
}

.btn-group .btn:last-child {
  margin-right: 0;
}

.btn-group-vertical .btn {
  margin-bottom: 0.25rem;
}

.btn-group-vertical .btn:last-child {
  margin-bottom: 0;
}

.rating {
  display: flex;
  align-items: center;
}

.rating-mobile {
  display: inline-flex;
  align-items: center;
  font-size: 0.875rem;
}

/* Mobile Card Styles */
.mobile-card {
  background: #fff;
  border: 1px solid #e3e3e3;
  border-radius: 8px;
  margin-bottom: 1rem;
  overflow: hidden;
  transition: box-shadow 0.2s ease;
}

.mobile-card:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.mobile-image {
  width: 100%;
  height: 120px;
  object-fit: cover;
}

.mobile-card-body {
  padding: 1rem;
}

.mobile-card-title {
  font-weight: 600;
  color: #525f7f;
  font-size: 1rem;
}

.mobile-card-text {
  font-size: 0.875rem;
  color: #8898aa;
  margin-bottom: 0.5rem;
  line-height: 1.4;
}

.mobile-card-meta {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
}

.mobile-actions {
  display: flex;
  gap: 0.25rem;
}

.badge-sm {
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
}

@media (max-width: 576px) {
  .mobile-actions {
    flex-direction: column;
  }
  
  .mobile-actions .btn {
    margin-right: 0 !important;
    margin-bottom: 0.25rem;
  }
  
  .mobile-actions .btn:last-child {
    margin-bottom: 0;
  }
  
  .mobile-card-body {
    padding: 0.75rem;
  }
}

.menu-item-details .info-item {
  margin-bottom: 0.5rem;
}

.pagination .page-link {
  color: #1d8cf8;
  border-color: #dee2e6;
}

.pagination .page-item.active .page-link {
  background-color: #1d8cf8;
  border-color: #1d8cf8;
}

.pagination .page-link:hover {
  color: #0c5aa6;
  background-color: #e9ecef;
  border-color: #dee2e6;
}

.modal-title {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}
</style>
