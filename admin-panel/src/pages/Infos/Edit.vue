<template>
  <div>
    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <card class="card-chart">
          <template slot="header">
            <div class="row">
              <div class="col-sm-6 text-left">
                <h2 class="card-title">Restaurant Information</h2>
                <p class="card-category">
                  <i class="tim-icons icon-settings-gear-63 text-primary"></i>
                  Manage your restaurant's basic details
                </p>
              </div>
              <div class="col-sm-6">
                <div class="btn-group-toggle float-right" data-toggle="buttons">
                  <router-link to="/dashboard" class="btn btn-sm btn-primary btn-simple">
                    <i class="tim-icons icon-minimal-left"></i>
                    Back to Dashboard
                  </router-link>
                </div>
              </div>
            </div>
          </template>
        </card>
      </div>
    </div>

    <!-- Unified Restaurant Information Form -->
    <div class="row">
      <div class="col-lg-10 col-md-12 col-sm-12 mx-auto">
        <card>
          <template slot="header">
            <h4 class="card-title">
              <i class="tim-icons icon-settings text-primary"></i>
              Restaurant Information Management
            </h4>
            <p class="card-category">Complete restaurant profile - Basic info, contact details, and settings</p>
          </template>

          <!-- Loading State -->
          <div v-if="isLoading" class="loading-container">
            <div class="loading-spinner">
              <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
            </div>
            <p class="text-center text-muted mt-3">Loading restaurant information...</p>
          </div>

          <!-- Error State -->
          <div v-else-if="error" class="error-container">
            <div class="alert alert-danger text-center">
              <i class="tim-icons icon-alert-circle-exc"></i>
              Failed to load restaurant information. Please try again.
              <br>
              <base-button
                type="primary"
                size="sm"
                @click="getRestaurantInfo"
                class="mt-3"
              >
                <i class="tim-icons icon-refresh-01"></i>
                Retry
              </base-button>
            </div>
          </div>

          <!-- Unified Form -->
          <form v-else @submit.prevent="submitAllInfo">
            <!-- Success Message -->
            <div v-if="showSuccessMessage" class="alert alert-success alert-dismissible fade show">
              <span class="alert-inner--icon">
                <i class="tim-icons icon-check-2"></i>
              </span>
              <span class="alert-inner--text">
                <strong>Success!</strong> All restaurant information updated successfully!
              </span>
              <button type="button" class="close" @click="showSuccessMessage = false">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- Basic Information Section -->
            <div class="form-section">
              <h5 class="section-title">
                <i class="tim-icons icon-shop text-primary"></i>
                Basic Information
              </h5>
              <hr class="section-divider">

            <!-- Restaurant Name -->
            <div class="row">
              <div class="col-md-12">
                <base-input
                  label="Restaurant Name *"
                  placeholder="Enter your restaurant name (e.g., The Golden Spoon)"
                  v-model="info.name"
                  :class="{ 'has-danger': errors.name }"
                  required
                  @input="clearFieldError('name')"
                >
                  <template slot="prepend">
                    <span class="input-group-text">
                      <i class="tim-icons icon-shop text-primary"></i>
                    </span>
                  </template>
                  <small v-if="errors.name" class="text-danger">
                    <i class="tim-icons icon-alert-circle-exc"></i>
                    {{ errors.name }}
                  </small>
                </base-input>
              </div>
            </div>
            <!-- Restaurant headline -->
            <div class="row">
              <div class="col-md-12">
                <base-input
                  label="Restaurant Headline *"
                  placeholder="Enter a catchy headline for your restaurant"
                  v-model="info.headline"
                  :class="{ 'has-danger': errors.headline }"
                  required
                  @input="clearFieldError('headline')"
                >
                  <template slot="prepend">
                    <span class="input-group-text">
                      <i class="tim-icons icon-bullet-list-67 text-primary"></i>
                    </span>
                  </template>
                  <small v-if="errors.headline" class="text-danger">
                    <i class="tim-icons icon-alert-circle-exc"></i>
                    {{ errors.headline }}
                  </small>
                </base-input>
              </div>
            </div>
            <!-- Restaurant Description -->
            <div class="row">
              <div class="col-md-12">
                <base-input>
                  <label>Restaurant Description *</label>
                  <textarea
                    rows="5"
                    class="form-control"
                    placeholder="Describe your restaurant, cuisine type, atmosphere, and what makes it special..."
                    v-model="info.description"
                    :class="{ 'has-danger': errors.description }"
                    required
                    @input="clearFieldError('description')"
                  ></textarea>
                  <small v-if="errors.description" class="text-danger d-block mt-2">
                    <i class="tim-icons icon-alert-circle-exc"></i>
                    {{ errors.description }}
                  </small>
                  <small class="text-muted d-block mt-1">
                    {{ info.description.length }} / 500 characters
                    <span v-if="info.description.length < 20" class="text-warning">
                      (Minimum 20 characters required)
                    </span>
                  </small>
                </base-input>
              </div>
            </div>
            </div>

            <!-- Contact Information Section -->
            <div class="form-section mt-4">
              <h5 class="section-title">
                <i class="tim-icons icon-square-pin text-info"></i>
                Contact Information
              </h5>
              <hr class="section-divider">

              <!-- Address -->
              <div class="row">
                <div class="col-md-12">
                  <base-input
                    label="Restaurant Address *"
                    placeholder="Enter your complete restaurant address"
                    v-model="contact.address"
                    :class="{ 'has-danger': contactErrors.address }"
                    required
                    @input="clearContactFieldError('address')"
                  >
                    <template slot="prepend">
                      <span class="input-group-text">
                        <i class="tim-icons icon-square-pin text-info"></i>
                      </span>
                    </template>
                    <small v-if="contactErrors.address" class="text-danger">
                      <i class="tim-icons icon-alert-circle-exc"></i>
                      {{ contactErrors.address }}
                    </small>
                  </base-input>
                </div>
              </div>

              <!-- Phone Numbers Row -->
              <div class="row">
                <div class="col-md-6">
                  <base-input
                    label="Mobile Phone *"
                    placeholder="+32 2 123 45 67"
                    v-model="contact.phone_number"
                    :class="{ 'has-danger': contactErrors.phone_number }"
                    required
                    @input="clearContactFieldError('phone_number')"
                  >
                    <template slot="prepend">
                      <span class="input-group-text">
                        <i class="tim-icons icon-mobile text-info"></i>
                      </span>
                    </template>
                    <small v-if="contactErrors.phone_number" class="text-danger">
                      <i class="tim-icons icon-alert-circle-exc"></i>
                      {{ contactErrors.phone_number }}
                    </small>
                  </base-input>
                </div>
                <div class="col-md-6">
                  <base-input
                    label="Fixed Phone"
                    placeholder="+32 2 987 65 43"
                    v-model="contact.phone_fix"
                    :class="{ 'has-danger': contactErrors.phone_fix }"
                    @input="clearContactFieldError('phone_fix')"
                  >
                    <template slot="prepend">
                      <span class="input-group-text">
                        <i class="tim-icons icon-phone-2 text-info"></i>
                      </span>
                    </template>
                    <small v-if="contactErrors.phone_fix" class="text-danger">
                      <i class="tim-icons icon-alert-circle-exc"></i>
                      {{ contactErrors.phone_fix }}
                    </small>
                  </base-input>
                </div>
              </div>

              <!-- Email -->
              <div class="row">
                <div class="col-md-12">
                  <base-input
                    label="Email Address *"
                    type="email"
                    placeholder="contact@yourrestaurant.com"
                    v-model="contact.gmail"
                    :class="{ 'has-danger': contactErrors.gmail }"
                    required
                    @input="clearContactFieldError('gmail')"
                  >
                    <template slot="prepend">
                      <span class="input-group-text">
                        <i class="tim-icons icon-email-85 text-info"></i>
                      </span>
                    </template>
                    <small v-if="contactErrors.gmail" class="text-danger">
                      <i class="tim-icons icon-alert-circle-exc"></i>
                      {{ contactErrors.gmail }}
                    </small>
                  </base-input>
                </div>
              </div>
            </div>

            <!-- Unified Form Actions -->
            <div class="row mt-5">
              <div class="col-md-12">
                <div class="form-actions text-center">
                  <base-button
                    type="primary"
                    size="lg"
                    :disabled="!isAllFormValid || !hasAnyChanges || isSubmitting"
                    @click="submitAllInfo"
                    class="btn-update-all"
                  >
                    <i class="tim-icons icon-check-2" v-if="!isSubmitting"></i>
                    <i class="fa fa-spinner fa-spin" v-if="isSubmitting"></i>
                    {{ isSubmitting ? 'Updating All Information...' : 'Update All Information' }}
                  </base-button>

                  <base-button
                    type="secondary"
                    size="lg"
                    @click="resetAllForms"
                    :disabled="!hasAnyChanges || isSubmitting"
                    class="ml-3"
                  >
                    <i class="tim-icons icon-refresh-01"></i>
                    Reset All Changes
                  </base-button>

                  <router-link to="/dashboard" class="btn btn-link btn-lg ml-3">
                    <i class="tim-icons icon-minimal-left"></i>
                    Cancel
                  </router-link>
                </div>
              </div>
            </div>

            <!-- Unified Form Status Indicator -->
            <div class="row mt-3" v-if="hasAnyChanges">
              <div class="col-md-12">
                <div class="alert alert-info alert-sm text-center">
                  <i class="tim-icons icon-bell-55"></i>
                  You have unsaved changes in your restaurant information
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
import { restaurantInfo, getRestaurantInfo, updateBasicInfo, isLoading, error } from '@/stores/restaurant';

export default {
  name: 'EditRestaurantInfo',
  components: {
    BaseInput,
    BaseButton,
    Card
  },
  data() {
    return {
      info: {
        name: '',
        headline: '',
        description: ''
      },
      originalInfo: {
        name: '',
        headline: '',
        description: ''
      },
      contact: {
        address: '',
        phone_number: '',
        phone_fix: '',
        gmail: ''
      },
      originalContact: {
        address: '',
        phone_number: '',
        phone_fix: '',
        gmail: ''
      },
      errors: {},
      contactErrors: {},
      isSubmitting: false,
      isSubmittingContact: false,
      showSuccessMessage: false,
      showContactSuccessMessage: false
    }
  },
  computed: {
    isLoading() {
      return isLoading.value;
    },
    error() {
      return error.value;
    },
    restaurantInfo() {
      return restaurantInfo.value;
    },
    hasChanges() {
      return this.info.name !== this.originalInfo.name ||
             this.info.headline !== this.originalInfo.headline ||
             this.info.description !== this.originalInfo.description;
    },
    hasContactChanges() {
      return this.contact.address !== this.originalContact.address ||
             this.contact.phone_number !== this.originalContact.phone_number ||
             this.contact.phone_fix !== this.originalContact.phone_fix ||
             this.contact.gmail !== this.originalContact.gmail;
    },
    hasAnyChanges() {
      return this.hasChanges || this.hasContactChanges;
    },
    isFormValid() {
      return this.info.name.trim().length >= 2 &&
             this.info.name.trim().length <= 100 &&
             this.info.headline.trim().length >= 5 &&
             this.info.headline.trim().length <= 150 &&
             this.info.description.trim().length >= 20 &&
             this.info.description.trim().length <= 500;
    },
    isContactFormValid() {
      return this.contact.address.trim().length >= 5 &&
             this.contact.phone_number.trim().length >= 8 &&
             this.isValidEmail(this.contact.gmail);
    },
    isAllFormValid() {
      return this.isFormValid && this.isContactFormValid;
    }
  },
  methods: {
    async getRestaurantInfo() {
      await getRestaurantInfo();
      this.loadRestaurantData();
    },

    loadRestaurantData() {
      this.info = {
        name: this.restaurantInfo.name || '',
        headline: this.restaurantInfo.headline || '',
        description: this.restaurantInfo.description || ''
      };
      this.originalInfo = {
        name: this.restaurantInfo.name || '',
        headline: this.restaurantInfo.headline || '',
        description: this.restaurantInfo.description || ''
      };
      
      this.contact = {
        address: this.restaurantInfo.address || '',
        phone_number: this.restaurantInfo.phone_number || '',
        phone_fix: this.restaurantInfo.phone_fix || '',
        gmail: this.restaurantInfo.gmail || ''
      };
      this.originalContact = {
        address: this.restaurantInfo.address || '',
        phone_number: this.restaurantInfo.phone_number || '',
        phone_fix: this.restaurantInfo.phone_fix || '',
        gmail: this.restaurantInfo.gmail || ''
      };
    },

    validateForm() {
      this.errors = {};
      let isValid = true;

      // Validate restaurant name
      if (!this.info.name || this.info.name.trim().length < 2) {
        this.errors.name = 'Restaurant name must be at least 2 characters long';
        isValid = false;
      } else if (this.info.name.length > 100) {
        this.errors.name = 'Restaurant name must be less than 100 characters';
        isValid = false;
      }

      // Validate description
      if (!this.info.description || this.info.description.trim().length < 20) {
        this.errors.description = 'Description must be at least 20 characters long';
        isValid = false;
      } else if (this.info.description.length > 500) {
        this.errors.description = 'Description must be less than 500 characters';
        isValid = false;
      }

      return isValid;
    },

    clearFieldError(field) {
      if (this.errors[field]) {
        delete this.errors[field];
      }
    },

    async submitRestaurantInfo() {
      if (!this.validateForm()) {
        this.showErrorNotification('Please fix the errors in the form');
        return;
      }

      this.isSubmitting = true;
      this.showSuccessMessage = false;

      try {
        await updateBasicInfo({
          name: this.info.name.trim(),
          description: this.info.description.trim()
        });

        // Update original info to reflect saved state
        this.originalInfo = {
          name: this.info.name,
          description: this.info.description
        };

        this.showSuccessMessage = true;
        this.showSuccessNotification('Restaurant information updated successfully!');

        // Hide success message after 5 seconds
        setTimeout(() => {
          this.showSuccessMessage = false;
        }, 5000);

      } catch (error) {
        console.error('Error updating restaurant info:', error);
        this.showErrorNotification('Failed to update restaurant information. Please try again.');
      } finally {
        this.isSubmitting = false;
      }
    },

    resetForm() {
      this.info = {
        name: this.originalInfo.name,
        description: this.originalInfo.description
      };
      this.errors = {};
      this.showSuccessMessage = false;
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

  async mounted() {
    await this.getRestaurantInfo();

    // Focus on the name input when component mounts
    this.$nextTick(() => {
      const nameInput = this.$el.querySelector('input[placeholder*="restaurant name"]');
      if (nameInput) {
        nameInput.focus();
      }
    });
  }
};
</script>

<style scoped>
.loading-container {
  padding: 3rem;
  text-align: center;
}

.loading-spinner {
  margin-bottom: 1rem;
}

.error-container {
  padding: 2rem;
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

.alert-sm {
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
}

.alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
}

.alert-info {
  background-color: #cce7ff;
  border-color: #1d8cf8;
  color: #0c5aa6;
}

.alert-danger {
  background-color: #f8d7da;
  border-color: #f5c6cb;
  color: #721c24;
}

.close {
  position: absolute;
  top: 0;
  right: 0;
  padding: 0.75rem 1.25rem;
  color: inherit;
  background: none;
  border: none;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1;
  opacity: 0.5;
  cursor: pointer;
}

.close:hover {
  opacity: 0.75;
}

.btn-link {
  color: #1d8cf8;
  text-decoration: none;
}

.btn-link:hover {
  color: #0c5aa6;
  text-decoration: underline;
}

/* Character counter styling */
textarea + small {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Improved textarea styling */
textarea.form-control {
  resize: vertical;
  min-height: 120px;
}

textarea.form-control:focus {
  border-color: #1d8cf8;
  box-shadow: 0 0 0 0.2rem rgba(29, 140, 248, 0.25);
}

/* Button states */
.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .form-actions .btn {
    display: block;
    width: 100%;
    margin: 0.5rem 0;
  }

  .form-actions .btn-link {
    display: inline-block;
    width: auto;
    margin: 1rem 0 0 0;
  }
}
</style>
