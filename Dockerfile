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

# ---------- Stage 3: PHP 8.4 + Nginx runtime ----------
FROM php:8.4-fpm-alpine

# System packages: nginx, supervisor, and libs needed to build PHP extensions
RUN apk add --no-cache \
    nginx \
    supervisor \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev

# PHP extensions Laravel typically needs
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl

WORKDIR /var/www/html

# App code
COPY . .

# Installed PHP deps from stage 2
COPY --from=vendor /app/vendor ./vendor

# Built frontend assets from stage 1
COPY --from=frontend /app/public/build ./public/build

# Nginx + Supervisor config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh scripts/*.sh 2>/dev/null || true

# Laravel storage/cache dirs must be writable
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

EXPOSE 80

CMD ["/entrypoint.sh"]