<template>
  <div>
    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <card class="card-chart">
          <template slot="header">
            <div class="row">
              <div class="col-sm-6 text-left">
                <h2 class="card-title">Add New Menu Item</h2>
                <p class="card-category">
                  <i class="tim-icons icon-app text-primary"></i>
                  Create a new menu item for your restaurant
                </p>
              </div>
              <div class="col-sm-6">
                <div class="btn-group-toggle float-right" data-toggle="buttons">
                  <router-link to="/menus/list" class="btn btn-sm btn-primary btn-simple">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    View Menu Items
                  </router-link>
                </div>
              </div>
            </div>
          </template>
        </card>
      </div>
    </div>

    <!-- Menu Item Form -->
    <div class="row">
      <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <card>
          <template slot="header">
            <h4 class="card-title">
              <i class="tim-icons icon-simple-add text-success"></i>
              Menu Item Information
            </h4>
            <p class="card-category">Fill in the details for the new menu item</p>
          </template>

          <form @submit.prevent="submitMenuItem">
            <!-- Category Name -->
            <div class="row">
              <div class="col-md-12">
                <base-input
                  label="Category Name *"
                  placeholder="Select or enter category (e.g., Appetizers, Main Course, Desserts)"
                  v-model="menuItem.categoryName"
                  :class="{ 'has-danger': errors.categoryName }"
                  required
                >
                  <small v-if="errors.categoryName" class="text-danger">{{ errors.categoryName }}</small>
                </base-input>
              </div>
            </div>

            <!-- Menu Item Name -->
            <div class="row">
              <div class="col-md-12">
                <base-input
                  label="Item Name *"
                  placeholder="Enter menu item name (e.g., Grilled Chicken Sandwich)"
                  v-model="menuItem.name"
                  :class="{ 'has-danger': errors.name }"
                  required
                >
                  <small v-if="errors.name" class="text-danger">{{ errors.name }}</small>
                </base-input>
              </div>
            </div>

            <!-- Price -->
            <div class="row">
              <div class="col-md-12">
                <base-input
                  label="Price *"
                  type="number"
                  step="0.01"
                  min="0"
                  placeholder="Enter price (e.g., 12.99)"
                  v-model="menuItem.price"
                  :class="{ 'has-danger': errors.price }"
                  required
                >
                  <template slot="prepend">
                    <span class="input-group-text">$</span>
                  </template>
                  <small v-if="errors.price" class="text-danger">{{ errors.price }}</small>
                </base-input>
              </div>
            </div>

            <!-- Description -->
            <div class="row">
              <div class="col-md-12">
                <base-input>
                  <label>Description *</label>
                  <textarea
                    rows="4"
                    class="form-control"
                    placeholder="Describe the menu item, ingredients, and preparation method"
                    v-model="menuItem.description"
                    :class="{ 'has-danger': errors.description }"
                    required
                  ></textarea>
                  <small v-if="errors.description" class="text-danger">{{ errors.description }}</small>
                </base-input>
              </div>
            </div>

            <!-- Menu Item Image -->
            <div class="row">
              <div class="col-md-12">
                <label class="form-control-label">Menu Item Image *</label>
                <div
                  class="image-upload-container"
                  :class="{ 'has-image': menuItem.imagePreview, 'has-error': errors.image }"
                  @dragover.prevent
                  @dragenter.prevent
                  @drop.prevent="handleImageDrop"
                  @click="triggerFileInput"
                >
                  <input
                    ref="fileInput"
                    type="file"
                    accept="image/*"
                    @change="handleImageUpload"
                    style="display: none;"
                  />

                  <div v-if="!menuItem.imagePreview" class="upload-placeholder">
                    <i class="tim-icons icon-cloud-upload-94 upload-icon"></i>
                    <h4>Upload Menu Item Image</h4>
                    <p>Drag and drop an image here, or click to browse</p>
                    <small class="text-muted">Supported formats: JPG, PNG, GIF (Max 5MB)</small>
                  </div>

                  <div v-else class="image-preview-container">
                    <img :src="menuItem.imagePreview" alt="Menu Item Image Preview" class="preview-image" />
                    <div class="image-overlay">
                      <button type="button" class="btn btn-sm btn-danger" @click.stop="removeImage">
                        <i class="tim-icons icon-simple-remove"></i>
                        Remove
                      </button>
                      <button type="button" class="btn btn-sm btn-primary ml-2" @click.stop="triggerFileInput">
                        <i class="tim-icons icon-image-02"></i>
                        Change
                      </button>
                    </div>
                  </div>
                </div>
                <small v-if="errors.image" class="text-danger d-block mt-2">
                  <i class="tim-icons icon-alert-circle-exc"></i>
                  {{ errors.image }}
                </small>
              </div>
            </div>

            <!-- Form Actions -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-actions text-center">
                  <base-button
                    type="primary"
                    size="lg"
                    :disabled="isSubmitting"
                    @click="submitMenuItem"
                  >
                    <i class="tim-icons icon-check-2" v-if="!isSubmitting"></i>
                    <i class="fa fa-spinner fa-spin" v-if="isSubmitting"></i>
                    {{ isSubmitting ? 'Creating...' : 'Create Menu Item' }}
                  </base-button>

                  <base-button
                    type="secondary"
                    size="lg"
                    @click="resetForm"
                    :disabled="isSubmitting"
                    class="ml-2"
                  >
                    <i class="tim-icons icon-refresh-01"></i>
                    Reset
                  </base-button>

                  <router-link to="/menus/list" class="btn btn-link btn-lg ml-2">
                    <i class="tim-icons icon-minimal-left"></i>
                    Back to List
                  </router-link>
                </div>
              </div>
            </div>
          </form>
        </card>
      </div>
    </div>
  </div>
</template>

<script>
import { BaseInput, BaseButton, Card } from '@/components';

export default {
  name: 'AddMenuItem',
  components: {
    BaseInput,
    BaseButton,
    Card
  },
  data() {
    return {
      menuItem: {
        categoryName: '',
        name: '',
        price: '',
        description: '',
        image: null,
        imagePreview: null
      },
      errors: {},
      isSubmitting: false
    }
  },
  methods: {
    validateForm() {
      this.errors = {};
      let isValid = true;

      // Validate category name
      if (!this.menuItem.categoryName || this.menuItem.categoryName.trim().length < 2) {
        this.errors.categoryName = 'Category name must be at least 2 characters long';
        isValid = false;
      } else if (this.menuItem.categoryName.length > 50) {
        this.errors.categoryName = 'Category name must be less than 50 characters';
        isValid = false;
      }

      // Validate menu item name
      if (!this.menuItem.name || this.menuItem.name.trim().length < 2) {
        this.errors.name = 'Menu item name must be at least 2 characters long';
        isValid = false;
      } else if (this.menuItem.name.length > 100) {
        this.errors.name = 'Menu item name must be less than 100 characters';
        isValid = false;
      }

      // Validate price
      if (!this.menuItem.price || this.menuItem.price <= 0) {
        this.errors.price = 'Please enter a valid price greater than 0';
        isValid = false;
      } else if (this.menuItem.price > 999.99) {
        this.errors.price = 'Price must be less than $999.99';
        isValid = false;
      }

      // Validate description
      if (!this.menuItem.description || this.menuItem.description.trim().length < 10) {
        this.errors.description = 'Description must be at least 10 characters long';
        isValid = false;
      } else if (this.menuItem.description.length > 500) {
        this.errors.description = 'Description must be less than 500 characters';
        isValid = false;
      }

      // Validate image
      if (!this.menuItem.image) {
        this.errors.image = 'Please upload an image';
        isValid = false;
      }

      return isValid;
    },

    handleImageUpload(event) {
      const file = event.target.files[0];
      this.processImageFile(file);
    },

    handleImageDrop(event) {
      const file = event.dataTransfer.files[0];
      this.processImageFile(file);
    },

    processImageFile(file) {
      if (!file) return;

      // Clear previous errors
      delete this.errors.image;

      // Validate file type
      if (!file.type.startsWith('image/')) {
        this.errors.image = 'Please upload a valid image file';
        return;
      }

      // Validate file size (e.g., max 5MB)
      if (file.size > 5 * 1024 * 1024) {
        this.errors.image = 'Image size must be less than 5MB';
        return;
      }

      this.menuItem.image = file;

      // Create image preview
      const reader = new FileReader();
      reader.onload = (e) => {
        this.menuItem.imagePreview = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    triggerFileInput() {
      this.$refs.fileInput.click();
    },

    removeImage() {
      this.menuItem.image = null;
      this.menuItem.imagePreview = null;
      this.$refs.fileInput.value = '';
      delete this.errors.image;
    },

    async submitMenuItem() {
      if (!this.validateForm()) {
        this.showErrorNotification('Please fix the errors in the form');
        return;
      }

      this.isSubmitting = true;

      try {
        // Simulate API call with FormData for image upload
        const formData = new FormData();
        formData.append('categoryName', this.menuItem.categoryName);
        formData.append('name', this.menuItem.name);
        formData.append('price', this.menuItem.price);
        formData.append('description', this.menuItem.description);
        formData.append('image', this.menuItem.image);

        await this.createMenuItem(formData);

        this.showSuccessNotification('Menu item created successfully!');

        // Reset form after successful submission
        this.resetForm();

        // Redirect to menu items list
        setTimeout(() => {
          this.$router.push('/menus/list');
        }, 1500);

      } catch (error) {
        console.error('Error creating menu item:', error);
        this.showErrorNotification('Failed to create menu item. Please try again.');
      } finally {
        this.isSubmitting = false;
      }
    },

    async createMenuItem(formData) {
      // Simulate API call with delay
      return new Promise((resolve, reject) => {
        setTimeout(() => {
          // Simulate random success/failure for demo
          if (Math.random() > 0.1) { // 90% success rate
            resolve({ id: Date.now(), ...formData });
          } else {
            reject(new Error('Simulated API error'));
          }
        }, 2000);
      });
    },

    resetForm() {
      this.menuItem = {
        categoryName: '',
        name: '',
        price: '',
        description: '',
        image: null,
        imagePreview: null
      };
      this.errors = {};
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
    // Focus on the category name input when component mounts
    this.$nextTick(() => {
      const categoryInput = this.$el.querySelector('input[placeholder*="category"]');
      if (categoryInput) {
        categoryInput.focus();
      }
    });
  }
};
</script>

<style scoped>
.image-upload-container {
  border: 2px dashed #e3e3e3;
  border-radius: 8px;
  padding: 2rem;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
  background-color: #fafafa;
  min-height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.image-upload-container:hover {
  border-color: #1d8cf8;
  background-color: #f0f8ff;
}

.image-upload-container.has-error {
  border-color: #fd5d93;
  background-color: #fdf2f5;
}

.image-upload-container.has-image {
  padding: 0;
  border: none;
  background: none;
  min-height: auto;
}

.upload-placeholder {
  color: #999;
}

.upload-icon {
  font-size: 3rem;
  color: #1d8cf8;
  margin-bottom: 1rem;
}

.image-preview-container {
  position: relative;
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
}

.preview-image {
  width: 100%;
  height: 250px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.image-overlay {
  position: absolute;
  top: 10px;
  right: 10px;
  display: flex;
  gap: 5px;
}

.form-actions {
  margin-top: 2rem;
  padding-top: 2rem;
  border-top: 1px solid #e3e3e3;
}

.has-danger .form-control {
  border-color: #fd5d93;
}

.text-danger {
  color: #fd5d93 !important;
}

.input-group-text {
  background-color: #1d8cf8;
  color: white;
  border-color: #1d8cf8;
}
</style>
