#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

DB_PATH="database/browser-test.sqlite"
export APP_ENV=local
export DB_CONNECTION=sqlite
export DB_DATABASE="$DB_PATH"

touch "$DB_PATH"

php artisan migrate:fresh --seed --force --no-interaction

echo "Browser test database ready at $DB_PATH"
