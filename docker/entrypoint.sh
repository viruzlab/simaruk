#!/bin/sh
set -e

echo "Waiting for database to be ready..."
# A simple delay to ensure MySQL is up (can be improved with wait-for-it)
sleep 10

echo "Running migrations..."
php artisan migrate --force

echo "Clearing caches..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting PHP-FPM..."
exec "$@"
