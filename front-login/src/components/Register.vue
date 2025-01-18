<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
      <!-- Mensajes de éxito y error -->
      <div v-if="successMessage" class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-center">
        {{ successMessage }}
      </div>
      <div v-if="errorMessage" class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-center">
        {{ errorMessage }}
      </div>

      <h1 class="text-2xl font-bold mb-4 text-center text-gray-700">Registro de Usuario</h1>
      <form @submit.prevent="register" class="space-y-4">
        <!-- Nombre -->
        <div>
          <input 
            v-model="user.name" 
            @input="validateName" 
            placeholder="Nombre" 
            :class="{ 'border-red-500': errors.name }"
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
          <p v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</p>
        </div>

        <!-- Apellido -->
        <div>
          <input 
            v-model="user.last_name" 
            @input="validateLastName" 
            placeholder="Apellido" 
            :class="{ 'border-red-500': errors.last_name }"
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
          <p v-if="errors.last_name" class="text-red-500 text-sm">{{ errors.last_name }}</p>
        </div>

        <!-- Número -->
        <div>
          <input 
            v-model="user.phone_number" 
            @input="validatePhoneNumber" 
            placeholder="Número" 
            :class="{ 'border-red-500': errors.phone_number }"
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
          <p v-if="errors.phone_number" class="text-red-500 text-sm">{{ errors.phone_number }}</p>
        </div>

        <!-- Email -->
        <div>
          <input 
            v-model="user.email" 
            @input="validateEmail" 
            type="email" 
            placeholder="Email" 
            :class="{ 'border-red-500': errors.email }"
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
          <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</p>
        </div>

        <!-- Contraseña -->
        <div>
          <input 
            v-model="user.password" 
            @input="validatePassword" 
            type="password" 
            placeholder="Contraseña" 
            :class="{ 'border-red-500': errors.password }"
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
          <p v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</p>
        </div>

        <!-- Confirmar Contraseña -->
        <div>
          <input 
            v-model="user.password_confirmation" 
            type="password" 
            placeholder="Confirmar Contraseña" 
            :class="{ 'border-red-500': errors.password_confirmation }"
            required 
            class="border-gray-300 rounded-lg w-full" 
          />
          <p v-if="errors.password_confirmation" class="text-red-500 text-sm">{{ errors.password_confirmation }}</p>
        </div>

        <button 
          type="submit"
          class="bg-indigo-500 w-full text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
          Registrarse
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import apiClient from "../services/api";

export default {
  data() {
    return {
      user: {
        name: "",
        last_name: "",
        phone_number: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: {}, // Almacena mensajes de error específicos por campo
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    validateName() {
      this.errors.name = this.user.name.trim() ? "" : "El nombre no puede estar vacío.";
    },
    validateLastName() {
      this.errors.last_name = this.user.last_name.trim() ? "" : "El apellido no puede estar vacío.";
    },
    validatePhoneNumber() {
      const phoneRegex = /^[0-9]+$/;
      if (!this.user.phone_number.trim()) {
        this.errors.phone_number = "El número no puede estar vacío.";
      } else if (this.user.phone_number.length !== 10) {
        this.errors.phone_number = "El número debe tener 10 dígitos.";
      }
       else if (!phoneRegex.test(this.user.phone_number)) {
        this.errors.phone_number = "El número solo puede contener dígitos.";
      } else {
        this.errors.phone_number = "";
      }
    },
    validateEmail() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!this.user.email.trim()) {
        this.errors.email = "El correo no puede estar vacío.";
      } else if (!emailRegex.test(this.user.email)) {
        this.errors.email = "Por favor, introduce un correo válido.";
      } else {
        this.errors.email = "";
      }
    },
    validatePassword() {
      this.errors.password = this.user.password.length >= 8
        ? ""
        : "La contraseña debe tener al menos 8 caracteres.";
    },
    async register() {
      // Validar todos los campos
      this.validateName();
      this.validateLastName();
      this.validatePhoneNumber();
      this.validateEmail();
      this.validatePassword();

      // Detener el registro si hay errores
      if (Object.values(this.errors).some((error) => error)) {
        return;
      }

      try {
        const response = await apiClient.post("/register", this.user);

        this.successMessage = "Usuario creado con éxito!";
        this.user = {
          name: "",
          last_name: "",
          phone_number: "",
          email: "",
          password: "",
          password_confirmation: "",
        };

        setTimeout(() => {
          this.successMessage = "";
          this.$router.push("/");
        }, 2000);
      } catch (error) {
        // Manejar errores desde el backend
        if (error.response?.data?.errors?.email) {
          this.errors.email = "Este correo ya está registrado. Por favor, utiliza otro.";
        } else {
          this.errorMessage = error.response?.data?.message || "Error inesperado al registrar.";
        }
      }
    },
  },
};
</script>
