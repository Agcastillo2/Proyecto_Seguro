# Usamos una imagen base oficial con PHP 8.2 y el servidor web Caddy
FROM dunglas/frankenphp:1.1-php8.2

# Establecemos el directorio de trabajo dentro del contenedor
WORKDIR /app

# Instalamos las dependencias necesarias para Composer y Git
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Descargamos e instalamos Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos las dependencias primero para aprovechar el cache de Docker
COPY composer.json composer.lock ./

# Ahora sí, ejecutamos composer install.
RUN composer install --no-dev --no-interaction --no-scripts --no-plugins --optimize-autoloader --ignore-platform-reqs

# Copiamos el resto de los archivos de la aplicación
COPY . .

# Generamos el archivo .env a partir del de ejemplo
RUN cp .env.example .env

# Generamos la clave de la aplicación
RUN php artisan key:generate

# Establecemos los permisos correctos para Laravel
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# --- LÍNEA NUEVA Y CRUCIAL ---
# Damos permisos de ejecución al entrypoint y a frankenphp
RUN chmod +x /usr/local/bin/docker-php-entrypoint /usr/local/bin/frankenphp

# Exponemos el puerto que usará FrankenPHP
EXPOSE 80 443 443/udp