<template>
    <div class="home flex items-center justify-center min-h-screen bg-gray-50">
      <div class="text-center p-8 bg-white shadow-lg rounded-lg w-full max-w-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Bienvenido a la App LoginEase</h2>
        <div class="flex flex-col space-y-4">
          <router-link
            to="/register"
            class="text-white bg-blue-600 hover:bg-blue-700 transition duration-300 py-3 rounded-md text-xl"
          >
            Registrarse
          </router-link>
          <router-link
            to="/login"
            class="text-white bg-gray-800 hover:bg-gray-900 transition duration-300 py-3 rounded-md text-xl"
          >
            Iniciar sesión
          </router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Home",
  };
  </script>
  
  <style scoped>
  .home {
    background-color: #f7fafc;
  }
  
  h2 {
    font-size: 2rem;
    color: #2d3748;
  }
  
  .router-link {
    display: inline-block;
    text-align: center;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  .router-link:hover {
    text-decoration: none;
  }
  
  .router-link + .router-link {
    margin-top: 1rem;
  }
  
  .router-link:hover {
    transform: scale(1.05);
  }
  </style>
  