#!/usr/bin/env sh
set -eu

cd /app

mkdir -p \
    bootstrap/cache \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs

php artisan storage:link --force >/dev/null 2>&1 || true

exec "$@"
