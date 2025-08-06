<template>
  <div>
    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <card class="card-chart">
          <template slot="header">
            <div class="row">
              <div class="col-sm-6 text-left">
                <h2 class="card-title">Categories</h2>
                <p class="card-category">
                  <i class="tim-icons icon-puzzle-10 text-primary"></i>
                  Manage your item categories
                </p>
              </div>
              <div class="col-sm-6">
                <div class="btn-group-toggle float-right" data-toggle="buttons">
                  <router-link to="/categories/add" class="btn btn-sm btn-primary btn-simple">
                    <i class="tim-icons icon-simple-add"></i>
                    Add New Category
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
            <div class="col-md-6">
              <base-input
                placeholder="Search categories..."
                v-model="searchQuery"
                @input="filterCategories"
              >
                <template slot="prepend">
                  <span class="input-group-text">
                    <i class="tim-icons icon-zoom-split"></i>
                  </span>
                </template>
              </base-input>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-end align-items-center">
                <span class="text-muted mr-2">{{ filteredCategories.length }} categories found</span>
                <base-button
                  type="info"
                  size="sm"
                  @click="refreshCategories"
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

    <!-- Categories Table -->
    <div class="row" v-if="!isLoading">
      <div class="col-12">
        <card>
          <!-- Desktop Table View -->
          <div class="table-responsive d-none d-lg-block">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 80px;">Image</th>
                  <th style="width: 150px;">Name</th>
                  <th>Description</th>
                  <th style="width: 120px;">Items Count</th>
                  <th style="width: 130px;">Created Date</th>
                  <th style="width: 180px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in paginatedCategories" :key="category.id">
                  <td>
                    <img 
                      :src="category.image || '/img/placeholder-category.jpg'" 
                      :alt="category.name"
                      class="table-image"
                      @error="handleImageError"
                    />
                  </td>
                  <td>
                    <strong>{{ category.name }}</strong>
                  </td>
                  <td>
                    <span class="text-muted">{{ truncateText(category.description, 80) }}</span>
                  </td>
                  <td>
                    <span class="badge badge-info">
                      <i class="tim-icons icon-app"></i>
                      {{ category.itemsCount || 0 }}
                    </span>
                  </td>
                  <td>
                    <small class="text-muted">
                      {{ formatDate(category.createdAt) }}
                    </small>
                  </td>
                  <td>
                    <div class="btn-group-vertical btn-group-sm" role="group">
                      <base-button
                        type="info"
                        size="sm"
                        @click="viewDetails(category)"
                        title="View Details"
                        class="mb-1"
                      >
                        <i class="tim-icons icon-zoom-split"></i>
                      </base-button>
                      <base-button
                        type="warning"
                        size="sm"
                        @click="editCategory(category)"
                        title="Edit Category"
                        class="mb-1"
                      >
                        <i class="tim-icons icon-pencil"></i>
                      </base-button>
                      <base-button
                        type="danger"
                        size="sm"
                        @click="confirmDelete(category)"
                        title="Delete Category"
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
            <div class="mobile-card" v-for="category in paginatedCategories" :key="category.id">
              <div class="row no-gutters">
                <div class="col-4">
                  <img 
                    :src="category.image || '/img/placeholder-category.jpg'" 
                    :alt="category.name"
                    class="mobile-image"
                    @error="handleImageError"
                  />
                </div>
                <div class="col-8">
                  <div class="mobile-card-body">
                    <h6 class="mobile-card-title">{{ category.name }}</h6>
                    <p class="mobile-card-text">{{ truncateText(category.description, 60) }}</p>
                    <div class="mobile-card-meta">
                      <span class="badge badge-info badge-sm">
                        <i class="tim-icons icon-app"></i>
                        {{ category.itemsCount || 0 }} items
                      </span>
                      <small class="text-muted ml-2">
                        {{ formatDate(category.createdAt) }}
                      </small>
                    </div>
                    <div class="mobile-actions mt-2">
                      <base-button
                        type="info"
                        size="sm"
                        @click="viewDetails(category)"
                        title="View Details"
                        class="mr-1"
                      >
                        <i class="tim-icons icon-zoom-split"></i>
                      </base-button>
                      <base-button
                        type="warning"
                        size="sm"
                        @click="editCategory(category)"
                        title="Edit Category"
                        class="mr-1"
                      >
                        <i class="tim-icons icon-pencil"></i>
                      </base-button>
                      <base-button
                        type="danger"
                        size="sm"
                        @click="confirmDelete(category)"
                        title="Delete Category"
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
            <h4>Loading categories...</h4>
          </div>
        </card>
      </div>
    </div>

    <!-- Empty State -->
    <div class="row" v-if="!isLoading && filteredCategories.length === 0">
      <div class="col-12">
        <card>
          <div class="text-center py-5">
            <i class="tim-icons icon-puzzle-10 fa-3x text-muted mb-3"></i>
            <h4>No categories found</h4>
            <p class="text-muted">{{ searchQuery ? 'Try adjusting your search criteria' : 'Start by creating your first category' }}</p>
            <router-link to="/categories/add" class="btn btn-primary" v-if="!searchQuery">
              <i class="tim-icons icon-simple-add"></i>
              Add New Category
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
                Showing {{ (currentPage - 1) * itemsPerPage + 1 }} to {{ Math.min(currentPage * itemsPerPage, filteredCategories.length) }} of {{ filteredCategories.length }} categories
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
      <div v-if="categoryToDelete">
        <p>Are you sure you want to delete the category <strong>"{{ categoryToDelete.name }}"</strong>?</p>
        <p class="text-muted">This action cannot be undone.</p>
      </div>
      <template slot="footer">
        <base-button type="secondary" @click="showDeleteModal = false">Cancel</base-button>
        <base-button 
          type="danger" 
          @click="deleteCategory" 
          :disabled="isDeleting"
        >
          <i class="fa fa-spinner fa-spin" v-if="isDeleting"></i>
          <i class="tim-icons icon-simple-remove" v-else></i>
          {{ isDeleting ? 'Deleting...' : 'Delete' }}
        </base-button>
      </template>
    </modal>

    <!-- Category Details Modal -->
    <modal :show="showDetailsModal" @close="showDetailsModal = false" size="lg">
      <template slot="header">
        <h4 class="modal-title">
          <i class="tim-icons icon-zoom-split text-info"></i>
          Category Details
        </h4>
      </template>
      <div v-if="selectedCategory" class="category-details">
        <div class="row">
          <div class="col-md-6">
            <img 
              :src="selectedCategory.image || '/img/placeholder-category.jpg'" 
              :alt="selectedCategory.name"
              class="img-fluid rounded"
            />
          </div>
          <div class="col-md-6">
            <h3>{{ selectedCategory.name }}</h3>
            <p class="text-muted">{{ selectedCategory.description || 'No description available' }}</p>
            <hr>
            <div class="category-info">
              <div class="info-item">
                <strong>Items Count:</strong>
                <span class="ml-2">{{ selectedCategory.itemsCount || 0 }}</span>
              </div>
              <div class="info-item">
                <strong>Created:</strong>
                <span class="ml-2">{{ formatDate(selectedCategory.createdAt) }}</span>
              </div>
              <div class="info-item">
                <strong>Last Updated:</strong>
                <span class="ml-2">{{ formatDate(selectedCategory.updatedAt) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <template slot="footer">
        <base-button type="secondary" @click="showDetailsModal = false">Close</base-button>
        <base-button 
          type="warning" 
          @click="editCategory(selectedCategory)"
          v-if="selectedCategory"
        >
          <i class="tim-icons icon-pencil"></i>
          Edit Category
        </base-button>
      </template>
    </modal>
  </div>
</template>

<script>
import { BaseInput, BaseButton, Card, Modal } from '@/components';

export default {
  name: 'CategoriesList',
  components: {
    BaseInput,
    BaseButton,
    Card,
    Modal
  },
  data() {
    return {
      categories: [],
      filteredCategories: [],
      searchQuery: '',
      isLoading: true,
      isDeleting: false,
      showDeleteModal: false,
      showDetailsModal: false,
      categoryToDelete: null,
      selectedCategory: null,
      currentPage: 1,
      itemsPerPage: 10
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredCategories.length / this.itemsPerPage);
    },
    paginatedCategories() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredCategories.slice(start, end);
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
    async loadCategories() {
      this.isLoading = true;
      try {
        // Simulate API call - replace with actual API endpoint
        const response = await this.fetchCategories();
        this.categories = response;
        this.filteredCategories = [...this.categories];
      } catch (error) {
        console.error('Error loading categories:', error);
        this.showErrorNotification('Failed to load categories');
      } finally {
        this.isLoading = false;
      }
    },
    
    async fetchCategories() {
      // Simulate API call with sample data
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve([
            {
              id: 1,
              name: 'Appetizers',
              description: 'Delicious starters to begin your meal',
              image: 'https://images.unsplash.com/photo-1541014741259-de529411b96a?w=400',
              itemsCount: 12,
              createdAt: new Date('2024-01-15'),
              updatedAt: new Date('2024-01-20')
            },
            {
              id: 2,
              name: 'Main Course',
              description: 'Hearty and satisfying main dishes',
              image: 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400',
              itemsCount: 25,
              createdAt: new Date('2024-01-16'),
              updatedAt: new Date('2024-01-22')
            },
            {
              id: 3,
              name: 'Desserts',
              description: 'Sweet treats to end your meal perfectly',
              image: 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=400',
              itemsCount: 8,
              createdAt: new Date('2024-01-17'),
              updatedAt: new Date('2024-01-21')
            },
            {
              id: 4,
              name: 'Beverages',
              description: 'Refreshing drinks and specialty beverages',
              image: 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400',
              itemsCount: 15,
              createdAt: new Date('2024-01-18'),
              updatedAt: new Date('2024-01-23')
            },
            {
              id: 5,
              name: 'Salads',
              description: 'Fresh and healthy salad options',
              image: 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400',
              itemsCount: 10,
              createdAt: new Date('2024-01-19'),
              updatedAt: new Date('2024-01-24')
            },
            {
              id: 6,
              name: 'Soups',
              description: 'Warm and comforting soup varieties',
              image: 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400',
              itemsCount: 6,
              createdAt: new Date('2024-01-20'),
              updatedAt: new Date('2024-01-25')
            }
          ]);
        }, 1000);
      });
    },

    filterCategories() {
      if (!this.searchQuery.trim()) {
        this.filteredCategories = [...this.categories];
      } else {
        const query = this.searchQuery.toLowerCase();
        this.filteredCategories = this.categories.filter(category => 
          category.name.toLowerCase().includes(query) ||
          (category.description && category.description.toLowerCase().includes(query))
        );
      }
      this.currentPage = 1; // Reset to first page when filtering
    },

    refreshCategories() {
      this.loadCategories();
    },

    viewDetails(category) {
      this.selectedCategory = category;
      this.showDetailsModal = true;
    },

    editCategory(category) {
      // Navigate to edit page - you can implement this route
      this.$router.push(`/categories/edit/${category.id}`);
    },

    confirmDelete(category) {
      this.categoryToDelete = category;
      this.showDeleteModal = true;
    },

    async deleteCategory() {
      if (!this.categoryToDelete) return;
      
      this.isDeleting = true;
      try {
        // Simulate API call - replace with actual delete endpoint
        await this.deleteCategoryAPI(this.categoryToDelete.id);
        
        // Remove from local array
        this.categories = this.categories.filter(cat => cat.id !== this.categoryToDelete.id);
        this.filterCategories(); // Refresh filtered list
        
        this.showSuccessNotification('Category deleted successfully!');
        this.showDeleteModal = false;
        this.categoryToDelete = null;
      } catch (error) {
        console.error('Error deleting category:', error);
        this.showErrorNotification('Failed to delete category');
      } finally {
        this.isDeleting = false;
      }
    },

    async deleteCategoryAPI(categoryId) {
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
      event.target.src = '/img/placeholder-category.jpg';
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
    this.loadCategories();
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
  margin-bottom: 0.5rem;
  color: #525f7f;
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
  margin-bottom: 0.5rem;
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
}

.category-details .info-item {
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
