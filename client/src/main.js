import { createApp } from 'vue'
import App from './App.vue'
import store from "./store/index.js";
import router from './router';

import axios from 'axios';
axios.defaults.baseURL = import.meta.env.VITE_BASE_URL;


const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')
