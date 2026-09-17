# syntax=docker/dockerfile:1

# ---------- Stage 1: build frontend assets (Vite/Vue) ----------
FROM node:24-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install

COPY . .
RUN npm run build

# ---------- Stage 2: install PHP dependencies (Composer) ----------
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock* ./
COPY database ./database

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --prefer-dist \
    --no-interaction

COPY . .

RUN composer dump-autoload --optimize --no-dev

# ---------- Stage 3: PHP + Nginx runtime ----------
FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

RUN chmod +x scripts/*.sh || true

ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

CMD ["/start.sh"]