FROM composer:2 AS vendor

WORKDIR /app

COPY . .

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

FROM node:22-bookworm-slim AS frontend

WORKDIR /app

RUN apt-get update \
    && apt-get install -y --no-install-recommends php-cli unzip \
    && rm -rf /var/lib/apt/lists/*

COPY . .
COPY --from=vendor /app/vendor /app/vendor

RUN npm ci && npm run build

FROM dunglas/frankenphp:1-php8.3-bookworm AS app

WORKDIR /app

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && install-php-extensions pdo_mysql intl zip opcache pcntl

COPY . .
COPY --from=vendor /app/vendor /app/vendor
COPY --from=frontend /app/public/build /app/public/build
COPY docker/caddy/Caddyfile /etc/frankenphp/Caddyfile
COPY docker/scripts/entrypoint.sh /usr/local/bin/app-entrypoint
COPY docker/scripts/healthcheck.sh /usr/local/bin/healthcheck

RUN chmod +x /usr/local/bin/app-entrypoint /usr/local/bin/healthcheck \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views storage/logs bootstrap/cache

ENV APP_ENV=production

EXPOSE 80 443 443/udp

HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 CMD ["/usr/local/bin/healthcheck"]

ENTRYPOINT ["/usr/local/bin/app-entrypoint"]
CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
