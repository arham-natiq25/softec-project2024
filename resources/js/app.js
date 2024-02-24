import './bootstrap';


import { createApp } from 'vue';
import One from './components/One.vue'
const app = createApp({});

app.component('one',One);

app.mount("#app");


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
