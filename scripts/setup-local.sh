#!/usr/bin/env bash
# Local setup script for Linux/macOS
set -e
cd "$(dirname "$0")/.."

echo "Copy .env" 
[ -f .env ] || cp .env.example .env

echo "Ensure sqlite database file" 
[ -f database/database.sqlite ] || touch database/database.sqlite

echo "Composer install"
composer install --no-interaction

echo "Generate key"
php artisan key:generate

echo "Run migrations with sqlite override"
DB_CONNECTION=sqlite php artisan migrate --force

echo "Storage link"
php artisan storage:link || echo "storage:link failed"

echo "NPM install and build"
npm install
npm run build

echo "Clear caches"
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan view:cache


echo "Local setup complete. Run: php artisan serve"
