require('./bootstrap');

import { createApp } from 'vue';
import ProgressTracker from './components/ProgressTracker.vue';

const app = createApp({});

app.component('progress-tracker', ProgressTracker);

app.mount('#app');
