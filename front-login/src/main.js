import { createApp } from 'vue';
import App from './App.vue';
import router from './routes'; // Cambia la ruta si es diferente
import './style.css'; // Si tienes estilos globales

const app = createApp(App);

app.use(router); // Usa el router

app.mount('#app');
