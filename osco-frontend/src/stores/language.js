import { ref, computed } from 'vue';

// Language state
const selectedLanguage = ref('fr'); // Default to French
const isLanguageDropdownOpen = ref(false);

// Available languages based on your database structure
const languages = [
  {
    code: 'fr',
    name: 'Français',
    flag: 'https://flagcdn.com/w20/fr.png',
    dbField: 'fr' // Maps to database field
  },
  {
    code: 'en', 
    name: 'English',
    flag: 'https://flagcdn.com/w20/gb.png',
    dbField: 'en' // Maps to database field
  },
  {
    code: 'ar',
    name: 'العربية',
    flag: 'https://flagcdn.com/w20/sa.png', // Using Saudi Arabia flag for Arabic
    dbField: 'ar' // Maps to database field
  }
];

// Computed properties
const currentLanguage = computed(() => {
  return languages.find(lang => lang.code === selectedLanguage.value) || languages[0];
});

// Actions
const setLanguage = (languageCode) => {
  selectedLanguage.value = languageCode;
  localStorage.setItem('selectedLanguage', languageCode);
  isLanguageDropdownOpen.value = false;
};

const toggleLanguageDropdown = () => {
  isLanguageDropdownOpen.value = !isLanguageDropdownOpen.value;
};

// Initialize language from localStorage or default
const initializeLanguage = () => {
  const savedLanguage = localStorage.getItem('selectedLanguage');
  if (savedLanguage && languages.some(lang => lang.code === savedLanguage)) {
    selectedLanguage.value = savedLanguage;
  }
};

// Helper function to get localized text from database objects
const getLocalizedText = (textObject, fallback = '') => {
  if (!textObject) return fallback;
  
  // If it's already a string, return it
  if (typeof textObject === 'string') return textObject;
  
  // Try to get text in selected language
  const langCode = currentLanguage.value.dbField;
  if (textObject[langCode]) {
    return textObject[langCode];
  }
  
  // Fallback to English, then French, then Arabic, then any available
  return textObject.en || textObject.fr || textObject.ar || 
         Object.values(textObject)[0] || fallback;
};

// Export everything
export {
  selectedLanguage,
  isLanguageDropdownOpen,
  languages,
  currentLanguage,
  setLanguage,
  toggleLanguageDropdown,
  initializeLanguage,
  getLocalizedText
};
