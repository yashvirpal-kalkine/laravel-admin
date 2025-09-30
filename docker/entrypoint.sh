#!/bin/bash
set -e

echo "🟢 Starting Laravel container setup..."

echo "Fixing storage and bootstrap/cache permissions..."
mkdir -p /var/www/html/storage/framework/sessions
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# Composer
if [ ! -d "vendor" ]; then
    echo "📦 Installing composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Generate APP_KEY
if ! grep -q 'base64:' /var/www/.env; then
    echo "🔑 Generating Laravel APP_KEY..."
    php artisan key:generate || true
fi

# Generate session table migration if missing
if ! ls database/migrations/*_create_sessions_table.php 1> /dev/null 2>&1; then
    php artisan session:table || true
fi

# Optimize
php artisan optimize || true


# Run migrations + seed safely
#php artisan migrate:fresh --seed --force || true
#php artisan db:seed --force || true
php artisan migrate --force || true


# Start PHP-FPM in foreground
exec php-fpm -F