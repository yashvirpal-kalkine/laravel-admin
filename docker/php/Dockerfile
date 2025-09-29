# Use PHP FPM
FROM php:8.2-fpm-bookworm

# Fix Debian mirrors (Bookworm uses debian.sources instead of sources.list)
RUN if [ -f /etc/apt/sources.list ]; then \
        sed -i 's|http://deb.debian.org|https://deb.debian.org|g' /etc/apt/sources.list; \
    fi && \
    if [ -f /etc/apt/sources.list.d/debian.sources ]; then \
        sed -i 's|http://deb.debian.org|https://deb.debian.org|g' /etc/apt/sources.list.d/debian.sources; \
    fi && \
    apt-get update --fix-missing && \
    apt-get install -y --no-install-recommends \
        git \
        unzip \
        curl \
        gnupg \
        ca-certificates \
        libpq-dev \
        libzip-dev \
        libonig-dev \
        zip && \
    docker-php-ext-install pdo pdo_pgsql mbstring zip bcmath && \
    update-ca-certificates && \
    rm -rf /var/lib/apt/lists/*

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy entrypoint script
COPY /docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Create Laravel project if missing
RUN test -f artisan || composer create-project laravel/laravel .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Switch to www-data user
USER www-data

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
