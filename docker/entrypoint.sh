#!/bin/sh
set -e

echo "Linking storage..."
php artisan storage:link || true

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Starting services..."
exec supervisord -c /etc/supervisor/supervisord.conf