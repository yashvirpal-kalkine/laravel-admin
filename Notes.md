docker-compose down -v
docker-compose up -d --build

docker exec -it laravel_admin_app php artisan migrate:fresh --seed
docker exec -it laravel_admin_app composer update 
docker exec -it laravel_admin_php chown -R www-data:www-data /var/www/html/database
docker exec -it laravel_admin_php chown -R www-data:www-data /var/www/html/storage


find . -type f -name "*:Zone.Identifier" -delete
