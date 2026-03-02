#!/bin/sh

# Ensure database exists for SQLite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    mkdir -p "$(dirname "$DB_DATABASE")"
    if [ ! -f "$DB_DATABASE" ]; then
        touch "$DB_DATABASE"
    fi
    chown www-data:www-data "$DB_DATABASE"
    chown www-data:www-data "$(dirname "$DB_DATABASE")"
fi

# Run storage link if not exists
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations and seeders (only if DB is configured)
php artisan migrate --force
php artisan db:seed --force

# Set permissions for storage and cache (recursive)
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
nginx -g "daemon off;"
