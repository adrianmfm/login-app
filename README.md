# Proyecto: Sistema de Login y Registro con Laravel y Vue.js

Este proyecto incluye un backend desarrollado con **Laravel** y un frontend construido con **Vue.js**, utilizando **TailwindCSS** para estilos. Está diseñado para ser fácilmente instalable y ejecutable localmente.

## Estructura del Proyecto
```
plogin-app/
|-- login/   # Contiene el proyecto Laravel
|-- front-login/  # Contiene el proyecto Vue.js
```

---

## Requisitos Previos

### Requisitos Generales:
- [Git](https://git-scm.com/)
- [Node.js](https://nodejs.org/) (v16 o superior)
- [Composer](https://getcomposer.org/)
- [Valet](https://laravel.com/docs/valet) 

### Backend (Laravel):
- PHP >= 8.1
- Extensiones de PHP necesarias: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`
- [SQLite](https://www.sqlite.org/index.html) configurado como base de datos

### Frontend (Vue.js):
- npm o yarn para manejar dependencias

---

## Instalación

### 1. Clonar el repositorio
```bash
https://github.com/adrianmfm/login-app.git
cd login-app
```

### 2. Configuración del Backend (Laravel)
```bash
cd backend
```
1. Instalar las dependencias:
   ```bash
   composer install
   ```

2. Crear un archivo `.env` basado en `.env.example`:
   ```bash
   cp .env.example .env
   ```

3. Generar una clave de aplicación:
   ```bash
   php artisan key:generate
   ```

4. Configurar la base de datos en el archivo `.env`:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=../database/database.sqlite
   ```

5. Crear el archivo de base de datos SQLite:
   ```bash
   touch database/database.sqlite
   ```

6. Ejecutar las migraciones para crear las tablas:
   ```bash
   php artisan migrate
   ```

7. Iniciar el servidor de desarrollo:
   ```valet link login
    valet serve

   ```
   El servidor estará disponible en: [http://127.0.0.1:8000](http://127.0.0.1:8000).

### 3. Configuración del Frontend (Vue.js)
```bash
cd ../front-login
```
1. Instalar las dependencias:
   ```bash
   npm install
   ```

2. Crear un archivo `.env` basado en `.env.example`:
   ```bash
   cp .env.example .env
   ```

3. Iniciar el servidor de desarrollo:
   ```bash
   npm run dev
   ```
   El servidor estará disponible en: [http://login.test/](http://login.test/).

---

## Uso

1. **Registro**:
   - Accede a la página de registro desde el frontend.
   - Ingresa los datos requeridos y registra un nuevo usuario.

2. **Inicio de sesión**:
   - Ingresa las credenciales de un usuario registrado para iniciar sesión.

3. **Dashboard**:
   - Una vez autenticado, serás redirigido al dashboard donde se muestran los datos del usuario autenticado.

4. **Cerrar sesión**:
   - Usa el botón "Cerrar Sesión" en el dashboard para cerrar la sesión del usuario actual.

---


## Licencia
Este proyecto está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).

