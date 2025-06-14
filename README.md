# PROYECTOSEGURO

Este proyecto utiliza **Laravel 12.x**.

## Requisitos

- PHP >= 8.2
- Composer
- Node.js y npm
- Servidor de base de datos (MySQL, SQLite, PostgreSQL, etc.)

## Instalación

1. **Clona el repositorio:**
   ```sh
   git clone https://github.com/Agcastillo2/Proyecto_Seguro.git
   cd Proyecto_Seguro
   cd sistema-registro-ventas
   ```

2. **Instala dependencias de PHP:**
   ```sh
   composer install
   ```

3. **Instala dependencias de Node.js:**
   ```sh
   npm install
   ```

4. **Copia el archivo de entorno y configura tus variables:**

    En **Linux/MacOS**:
    ```sh
    cp .env.example .env
    ```

    En **Windows** (CMD):
    ```cmd
    copy .env.example .env
    ```

    En **Windows** (PowerShell):
    ```powershell
    Copy-Item .env.example .env
    ```
   Edita `.env` según tu configuración local (base de datos, correo, etc).

5. **Genera la clave de la aplicación:**
   ```sh
   php artisan key:generate
   ```

6. **Ejecuta las migraciones y seeders (opcional):**
   ```sh
   php artisan db:seed --class=RolesAndPermissionsSeeder
   ```

7. **Inicia el proyecto:**
   ```sh
   composer run dev
   ```

Accede a [http://localhost:8000](http://localhost:8000) en tu navegador.
