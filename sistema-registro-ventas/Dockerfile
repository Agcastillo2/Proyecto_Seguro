# --- ETAPA 1: CONSTRUCCIÓN DE DEPENDENCIAS ---
# Usamos una imagen de PHP 8.2 con Composer para instalar las dependencias
FROM composer:2 as vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist


# --- ETAPA 2: LA IMAGEN FINAL DE PRODUCCIÓN ---
# Usamos una imagen oficial de PHP 8.2 con FPM, optimizada para producción
FROM php:8.2-fpm-alpine

# Establecemos el directorio de trabajo
WORKDIR /app

# Instalamos las dependencias del sistema: Nginx, Git, y extensiones de PHP comunes para Laravel
RUN apk --no-cache add \
    nginx \
    supervisor \
    git \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip bcmath

# Copiamos el código de la aplicación (sin la carpeta vendor)
COPY . .

# Copiamos las dependencias de Composer que instalamos en la etapa 1
COPY --from=vendor /app/vendor/ ./vendor/

# Copiamos los archivos de configuración de Nginx y Supervisor
# (Estos los crearemos en el siguiente paso)
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# Generamos el archivo .env y la clave de la aplicación
RUN cp .env.example .env && php artisan key:generate

# Ajustamos los permisos para que Laravel pueda escribir en estas carpetas
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# Exponemos el puerto 8080 que usará Nginx
EXPOSE 8080


# El comando final para iniciar todo
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]