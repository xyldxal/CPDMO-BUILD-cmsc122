require('./bootstrap');


import { createApp } from 'vue';
import ProgressTracker from './components/ProgressTracker.vue';
import FormTemplate from './components/FormTemplate.vue';

const app = createApp({});

app.component('progress-tracker', ProgressTracker);
app.component('form-template', FormTemplate)

app.mount('#app');
