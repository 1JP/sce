# syntax=docker/dockerfile:1

# ---------- Stage 1: build frontend assets (Vite/Vue) ----------
FROM node:24-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install

COPY . .
RUN npm run build

# ---------- Stage 2: PHP + Nginx runtime ----------
FROM richarvey/nginx-php-fpm:3.1.6

# Copy the whole Laravel app
COPY . .

# Ensure deploy scripts are executable (Windows/git often strips this bit)
RUN chmod +x scripts/*.sh || true

# Bring in the built frontend assets from stage 1
COPY --from=frontend /app/public/build ./public/build

# Image config (richarvey/nginx-php-fpm specific env vars)
ENV SKIP_COMPOSER=0
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

# Laravel config
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Run migrations automatically on each deploy (safe with --force in production)
ENV RUN_SCRIPTS=1

CMD ["/start.sh"]