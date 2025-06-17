#!/bin/sh

# Salir inmediatamente si un comando falla
set -e

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Ejecutando seeders..."
php artisan db:seed --class=RolesAndPermissionsSeeder

echo "¡Despliegue preparado!"