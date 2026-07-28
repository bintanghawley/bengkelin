#!/usr/bin/env bash
# Exit immediately if a command exits with a non-zero status
set -e

echo "==> [1/5] Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> [2/5] Installing NPM dependencies & building assets..."
npm ci || npm install
npm run build

echo "==> [3/5] Pre-compiling & caching Laravel configuration..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "==> [4/5] Running database migrations & seeders..."
php artisan migrate --force --seed

echo "==> [5/5] Deployment build completed successfully!"
