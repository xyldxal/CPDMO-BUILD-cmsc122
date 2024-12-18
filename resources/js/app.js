import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Projects from './components/Projects.vue';
import AddEntryForm from './components/AddEntryForm.vue';

const app = createApp({});
app.component('projects', Projects);
app.component('add-entry-form', AddEntryForm);
app.mount('#app');
