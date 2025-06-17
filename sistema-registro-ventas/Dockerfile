# --- ETAPA 1: CONSTRUCCIÓN DE DEPENDENCIAS ---
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
FROM php:8.2-fpm-alpine

WORKDIR /app

# Instalamos las dependencias del sistema y los paquetes de desarrollo de Postgres
RUN apk --no-cache add \
    nginx \
    supervisor \
    git \
    libzip-dev \
    zip \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql zip bcmath

# Copiamos el código de la aplicación (sin la carpeta vendor)
COPY . .

# Copiamos las dependencias de Composer que instalamos en la etapa 1
COPY --from=vendor /app/vendor/ ./vendor/

# Copiamos los archivos de configuración de Nginx y Supervisor
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# Generamos el archivo .env y la clave de la aplicación.
RUN cp .env.example .env && php artisan key:generate

# Ajustamos los permisos para que Laravel pueda escribir en estas carpetas
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]