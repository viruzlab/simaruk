#!/bin/sh
set -e

echo "Waiting for database to be ready..."
# A simple delay to ensure MySQL is up (can be improved with wait-for-it)
sleep 10

echo "Running migrations..."
php artisan migrate --force || echo "WARNING: Migration failed, continuing anyway..."

echo "Clearing caches..."
php artisan optimize:clear || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting PHP-FPM..."
exec "$@"
