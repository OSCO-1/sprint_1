import axios from 'axios';

const api = axios.create({
  baseURL: (process.env.VUE_APP_API_URL || 'https://oscoapi-hjtj1.sevalla.app/api') + '/', // Ensure trailing slash
  headers: {
    'Content-Type': 'application/json',
  },
  timeout: 30000, // Increased to 30 seconds
  retry: 3, // Add retry attempts
});

// Add response interceptor for better error handling
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.code === 'ECONNABORTED' && error.message.includes('timeout')) {
      console.error('Request timeout - server may be slow or unresponsive');
      error.message = 'Server is taking too long to respond. Please try again.';
    }
    return Promise.reject(error);
  }
);

export default api;