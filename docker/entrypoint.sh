#!/bin/bash
set -e

echo "🟢 Starting Laravel container setup..."

# Ensure storage and bootstrap/cache directories exist
mkdir -p /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Install composer dependencies if vendor missing
if [ ! -d "vendor" ]; then
    echo "📦 Installing composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Generate APP_KEY if missing
if ! grep -q 'base64:' /var/www/.env; then
    echo "🔑 Generating Laravel APP_KEY..."
    php artisan key:generate || true
fi

# Start PHP-FPM in background first
echo "🚀 Starting PHP-FPM..."
php-fpm &

# Run Artisan cache commands asynchronously
echo "🧹 Running Laravel caches in background..."
(
    php artisan config:clear
    php artisan config:cache
    php artisan route:clear
    php artisan route:cache
    php artisan view:clear
    php artisan view:cache
    php artisan cache:clear
) &

# Run migrations asynchronously with retry
echo "⏳ Running migrations in background..."
(
    MAX_RETRIES=20
    COUNT=0
    until php artisan migrate --force >/dev/null 2>&1; do
        COUNT=$((COUNT+1))
        if [ $COUNT -ge $MAX_RETRIES ]; then
            echo "❌ Could not run migrations after $MAX_RETRIES attempts."
            break
        fi
        echo "Waiting for database to be ready... ($COUNT/$MAX_RETRIES)"
        sleep 3
    done
    echo "✅ Migrations complete."
) &

# Wait indefinitely so container doesn’t exit
wait
