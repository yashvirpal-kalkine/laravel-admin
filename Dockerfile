FROM php:8.2-fpm

RUN apt-get update && apt-get install -y libsqlite3-dev sqlite3 zip unzip git curl \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install --no-interaction --no-progress
RUN chown -R www-data:www-data storage bootstrap/cache || true

EXPOSE 9000
CMD ["php-fpm"]
