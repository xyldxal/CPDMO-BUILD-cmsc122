import './bootstrap'
import { createApp } from 'vue'
import Projects from './resources/js/components/Projects.vue'

const app = createApp({})
app.component('projects', Projects)
app.mount('#app')
