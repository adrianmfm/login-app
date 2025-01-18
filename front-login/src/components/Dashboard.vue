<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center text-gray-700">Bienvenido a LoginEase </h1>
        
        <!-- Información del Usuario -->
        <div v-if="user" class="space-y-4">
          <div>
            <strong class="text-gray-700">Nombre:</strong>
            <p class="text-gray-600">{{ user.name }}</p>
          </div>
          <div>
            <strong class="text-gray-700">Apellido:</strong>
            <p class="text-gray-600">{{ user.last_name }}</p>
          </div>
          <div>
            <strong class="text-gray-700">Email:</strong>
            <p class="text-gray-600">{{ user.email }}</p>
          </div>
          <div>
            <strong class="text-gray-700">Número:</strong>
            <p class="text-gray-600">{{ user.phone_number }}</p>
          </div>
        </div>
  
        <!-- Botón de Cerrar sesión -->
        <button @click="logout" class="bg-red-500 text-white py-2 px-4 rounded-md mt-4 w-full">
          Cerrar sesión
        </button>
        
        <!-- Si no se ha cargado la información o no hay token -->
      </div>
    </div>
  </template>
  
  <script>
  import apiClient from '../services/api'
  
  export default {
    data() {
      return {
        user: null,
      };
    },
  
    created() {
      this.fetchUserProfile();
    },
  
    methods: {
      async fetchUserProfile() {
        const token = localStorage.getItem('token');
        
        if (!token) {
          this.$router.push('/'); // Redirige al login si no hay token
          return;
        }
  
        try {
          // Realiza una solicitud para obtener el perfil del usuario
          const response = await apiClient.get('/profile', {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          // Asigna los datos del usuario al estado
          this.user = response.data;
        } catch (error) {
          console.error('Error al obtener el perfil del usuario:', error);
          this.$router.push('/login');
        }
      },
  
      async logout() {
        try {
          // Llamada a la API para cerrar sesión
          await apiClient.post('/logout');
  
          // Eliminar el token del localStorage
          localStorage.removeItem('token');
  
          // Redirige al login después de cerrar sesión
          this.$router.push('/');
        } catch (error) {
          console.error('Error al cerrar sesión:', error);
          // Puedes mostrar un mensaje de error si ocurre un problema
        }
      }
    }
  };
  </script>
  