#!/bin/sh
set -e

cd /var/www/html

echo "==> LogicsGrid starting..."

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set."
    echo "Add APP_KEY in Dokploy → Environment. Generate locally with: php artisan key:generate --show"
    exit 1
fi

if [ -n "$APP_URL" ]; then
    case "$APP_URL" in
        http://*|https://*) ;;
        *) export APP_URL="https://${APP_URL#/}" ;;
    esac
    export APP_URL="${APP_URL%/}"
    export ASSET_URL="$APP_URL"

    case "$APP_URL" in
        https://*)
            export SESSION_SECURE_COOKIE="${SESSION_SECURE_COOKIE:-true}"
            export SESSION_SAME_SITE="${SESSION_SAME_SITE:-lax}"
            ;;
    esac
fi

export SESSION_DRIVER="${SESSION_DRIVER:-database}"
# Leave SESSION_DOMAIN unset unless explicitly provided (string "null" breaks cookies)

if [ -z "$DB_CONNECTION" ]; then
    export DB_CONNECTION=sqlite
    export DB_DATABASE=/var/www/html/database/database.sqlite
    echo "==> No DB_CONNECTION set, using SQLite at ${DB_DATABASE}"
fi

mkdir -p storage/framework/{cache,sessions,views} storage/logs storage/app/public bootstrap/cache database

if [ "$DB_CONNECTION" = "sqlite" ]; then
    touch "${DB_DATABASE:-/var/www/html/database/database.sqlite}"
fi

chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true
chmod -R ug+rwx storage bootstrap/cache

php artisan storage:link --force 2>/dev/null || true

if [ "$DB_CONNECTION" = "mysql" ] || [ "$DB_CONNECTION" = "mariadb" ]; then
    echo "==> Waiting for MySQL at ${DB_HOST:-127.0.0.1}:${DB_PORT:-3306}..."
    ready=0
    for i in $(seq 1 30); do
        if php -r "
            try {
                new PDO(
                    'mysql:host=' . (getenv('DB_HOST') ?: '127.0.0.1') . ';port=' . (getenv('DB_PORT') ?: '3306'),
                    getenv('DB_USERNAME') ?: 'root',
                    getenv('DB_PASSWORD') ?: ''
                );
                exit(0);
            } catch (Throwable \$e) {
                exit(1);
            }
        " 2>/dev/null; then
            ready=1
            break
        fi
        sleep 2
    done
    if [ "$ready" -eq 0 ]; then
        echo "ERROR: Cannot connect to MySQL. Check DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD."
        exit 1
    fi
    echo "==> MySQL is ready."
fi

echo "==> Running migrations..."
php artisan migrate --force --no-interaction

if [ "${RUN_SEED:-true}" != "false" ]; then
    echo "==> Seeding database..."
    php artisan db:seed --force --no-interaction || echo "WARNING: Seeding skipped or failed."
fi

php artisan package:discover --ansi 2>/dev/null || true
php artisan livewire:publish --assets 2>/dev/null || true
php artisan filament:assets 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan config:cache
php artisan view:cache
php artisan filament:optimize 2>/dev/null || true

# Never cache routes in production for Livewire/Filament — dynamic routes break.

chown -R www-data:www-data storage bootstrap/cache

echo "==> Starting nginx + php-fpm on port 80..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
