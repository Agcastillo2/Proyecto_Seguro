#!/bin/sh
set -e

echo "Preparando la aplicación para producción..."

# Limpia todas las cachés de Laravel para asegurar una configuración fresca
# Este comando es un todo-en-uno que ejecuta: config:clear, route:clear, view:clear, etc.
php artisan optimize:clear

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Ejecutando seeders..."
php artisan db:seed --class=RolesAndPermissionsSeeder

echo "¡Despliegue preparado y optimizado!"