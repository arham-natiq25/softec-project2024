import './bootstrap';


import { createApp } from 'vue';
import One from './components/One.vue'
import Dashboard from './components/Dashboard.vue'
import Trips from './components/Trips.vue'
import Query from './components/Query.vue'
const app = createApp({});

app.component('one',One);
app.component('dashboard',Dashboard);
app.component('trips',Trips);
app.component('query',Query);

app.mount("#app");


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
