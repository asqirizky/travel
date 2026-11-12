#!/bin/sh
set -e

# Entrypoint ini hanya melakukan setup PHP saat container utama (php-fpm) dijalankan.
# Service lain (mis. Vite) cukup menjalankan command-nya langsung.
if [ "$1" = "php-fpm" ]; then
    echo "==> Menyiapkan direktori storage & cache..."
    mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/testing \
        storage/framework/views \
        storage/logs \
        bootstrap/cache
    chmod -R 777 storage bootstrap/cache 2>/dev/null || true

    echo "==> Memasang dependency PHP (Composer)..."
    if [ ! -f vendor/autoload.php ] || [ ! -f vendor/composer/installed.json ]; then
        composer install --no-interaction --prefer-dist --no-progress
    fi

    if [ ! -f .env ]; then
        echo "==> Membuat .env dari .env.example..."
        cp .env.example .env
        php artisan key:generate --force
    fi

    echo "==> Menjalankan migrasi database..."
    php artisan migrate --force

    if [ ! -L public/storage ]; then
        php artisan storage:link || true
    fi
fi

exec "$@"
