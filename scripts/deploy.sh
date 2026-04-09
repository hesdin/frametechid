#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
COMPOSE=(docker compose --env-file "${ROOT_DIR}/.env.production")

cd "${ROOT_DIR}"

if [[ ! -f .env.production ]]; then
    echo "Missing .env.production. Copy from .env.production.example first." >&2
    exit 1
fi

"${COMPOSE[@]}" up -d --build --remove-orphans

attempt=0
until "${COMPOSE[@]}" exec -T app php artisan migrate --force; do
    attempt=$((attempt + 1))

    if [[ ${attempt} -ge 12 ]]; then
        echo "Migration failed after multiple retries." >&2
        exit 1
    fi

    sleep 5
done

"${COMPOSE[@]}" exec -T app php artisan optimize:clear
"${COMPOSE[@]}" exec -T app php artisan optimize
"${COMPOSE[@]}" exec -T app php artisan queue:restart || true
"${COMPOSE[@]}" ps
