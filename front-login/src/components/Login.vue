<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
      <h1 class="text-2xl font-bold mb-4 text-center text-gray-700">Iniciar Sesión</h1>
      <form @submit.prevent="login" class="space-y-4">
        <!-- Campo Email -->
        <div>
          <input 
            v-model="user.email" 
            type="email" 
            placeholder="Email" 
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
        </div>
        <!-- Campo Contraseña -->
        <div>
          <input 
            v-model="user.password" 
            type="password" 
            placeholder="Contraseña" 
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
        </div>

        <button 
          type="submit"
          class="bg-indigo-500 w-full text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
          Iniciar Sesión
        </button>
      </form>

      <!-- Mensaje de error -->
      <p v-if="errorMessage" class="text-red-500 text-center mt-4">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script>
import apiClient from '../services/api';

export default {
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      errorMessage: ''
    };
  },

  methods: {
    validateInputs() {
      if (!this.user.email.trim()) {
        this.errorMessage = 'El campo de email no puede estar vacío.';
        return false;
      }

      if (!this.user.password.trim()) {
        this.errorMessage = 'El campo de contraseña no puede estar vacío.';
        return false;
      }

      if (this.user.password.includes(' ')) {
        this.errorMessage = 'La contraseña no puede contener espacios.';
        return false;
      }

      this.errorMessage = ''; // Limpiar el mensaje de error si pasa la validación.
      return true;
    },

    async login() {
      // Validar los inputs antes de enviar la solicitud.
      if (!this.validateInputs()) {
        return;
      }

      try {
        // Paso 1: Solicitar el token
        const response = await apiClient.post('/login', this.user);
        const token = response.data.token;
        console.log(response.data);

        if (token) {
          // Guardar el token en localStorage
          localStorage.setItem('token', token);

          // Paso 2: Solicitar el perfil del usuario
          const profileResponse = await apiClient.get('/profile', {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });

          // Redirigir al dashboard
          this.$router.push('/dashboard');
        } else {
          this.errorMessage = 'No se pudo obtener el token de acceso';
        }
      } catch (error) {
        if (error.response) {
          this.errorMessage = error.response.data.message || 'Error al iniciar sesión.';
        } else {
          this.errorMessage = 'No se pudo conectar con el servidor. Intenta nuevamente.';
        }
      }
    }
  }
};
</script>
