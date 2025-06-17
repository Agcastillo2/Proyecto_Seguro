# Usamos una imagen base oficial con PHP 8.2 y el servidor web Caddy
FROM dunglas/frankenphp:1.1-php8.2

# Establecemos el directorio de trabajo dentro del contenedor
WORKDIR /app

# --- INICIO DEL BLOQUE NUEVO ---
# Instalamos las dependencias necesarias para Composer y Git
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Descargamos e instalamos Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# --- FIN DEL BLOQUE NUEVO ---

# Copiamos las dependencias primero para aprovechar el cache de Docker
COPY composer.json composer.lock ./

# Ahora sí, ejecutamos composer install. Esta vez funcionará.
# Añadimos --ignore-platform-reqs para evitar problemas de versión de PHP.
RUN composer install --no-dev --no-interaction --no-scripts --no-plugins --optimize-autoloader --ignore-platform-reqs

# Copiamos el resto de los archivos de la aplicación
COPY . .

# Generamos el archivo .env a partir del de ejemplo (lo configuraremos en Render)
RUN cp .env.example .env

# Generamos la clave de la aplicación
RUN php artisan key:generate

# Establecemos los permisos correctos para Laravel
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# Exponemos el puerto que usará FrankenPHP
EXPOSE 80 443 443/udp