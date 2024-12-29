import '../css/app.css'; // Import CSS
import './bootstrap'; // Import Bootstrap

import { createApp } from 'vue'; // Import Vue
import router from './router'; // Import the router

// Create a Vue application instance
const app = createApp({});

// Use the router
app.use(router);

// Mount the Vue application to the #app div in your Blade file
app.mount('#app');




