#!/usr/bin/env bash
set -e

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache database
touch database/database.sqlite
chown -R www-data:www-data storage bootstrap/cache database

if [ ! -f .env ]; then
    cp .env.example .env
fi

php artisan key:generate --force --no-interaction || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache

apache2-foreground
