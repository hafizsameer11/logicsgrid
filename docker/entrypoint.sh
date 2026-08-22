#!/bin/sh
set -e

cd /var/www/html

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set. Generate one with: php artisan key:generate --show"
    exit 1
fi

mkdir -p storage/framework/{cache,sessions,views} storage/logs storage/app/public bootstrap/cache

if [ "$DB_CONNECTION" = "sqlite" ]; then
    mkdir -p database
    touch "${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    chown www-data:www-data "${DB_DATABASE:-/var/www/html/database/database.sqlite}" 2>/dev/null || true
fi

chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

php artisan storage:link --force 2>/dev/null || true

php artisan migrate --force --no-interaction

if [ "${RUN_SEED:-true}" != "false" ]; then
    echo "Seeding database (set RUN_SEED=false to skip on future deploys)..."
    php artisan db:seed --force --no-interaction
fi

php artisan package:discover --ansi 2>/dev/null || true

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:optimize 2>/dev/null || true

chown -R www-data:www-data storage bootstrap/cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
