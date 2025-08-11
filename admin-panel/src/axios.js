import axios from 'axios';

const api = axios.create({
  baseURL: (process.env.VUE_APP_API_URL || 'http://127.0.0.1:8000/api') + '/', // Ensure trailing slash
  headers: {
    'Content-Type': 'application/json',
  },
  timeout: 10000,
});



export default api;
