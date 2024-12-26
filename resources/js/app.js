import '../css/app.css';
import './bootstrap';

import { createApp } from 'vue'; // Import Vue
import CreateRecord from './Pages/CreateRecord.vue'; // Import the CreateRecord component

// Create a Vue application instance
const app = createApp({});

// Register the CreateRecord component globally
app.component('create-record', CreateRecord);

// Mount the Vue application to the #app div in your Blade file
app.mount('#app');


