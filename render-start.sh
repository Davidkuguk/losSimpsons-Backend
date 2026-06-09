#!/usr/bin/env bash
set -e

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache database
export DB_DATABASE="${DB_DATABASE:-$(pwd)/database/database.sqlite}"
touch "$DB_DATABASE"
chown -R www-data:www-data storage bootstrap/cache database

if [ ! -f .env ]; then
    cp .env.example .env
fi

php artisan config:clear --no-interaction || true
php artisan route:clear --no-interaction || true
php artisan key:generate --force --no-interaction || true
php artisan migrate --force
php artisan db:seed --force --no-interaction
php artisan config:cache
php artisan route:cache

apache2-foreground
