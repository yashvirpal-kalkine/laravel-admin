docker-compose down -v
docker-compose up -d --build

docker exec -it laravel_admin_app php artisan migrate:fresh --seed
docker exec -it laravel_admin_app composer update 
docker exec -it laravel_admin_app chown -R www-data:www-data /var/www/html/database
docker exec -it laravel_admin_app chown -R www-data:www-data /var/www/html/storage


find . -type f -name "*:Zone.Identifier" -delete



sudo chown -R $USER:$USER storage
sudo chown -R $USER:$USER database
sudo chown -R $USER:$USER bootstrap/cache


sudo chmod -R 775 storage
sudo chmod -R 775 database
sudo chmod -R 775 bootstrap/cache


docker exec -it laravel_admin_app ls -l /var/www/html

docker exec laravel_admin_app chown -R www-data:www-data /var/www/html/database
docker exec laravel_admin_app chmod -R 775 /var/www/html/database


docker exec laravel_admin_app chown -R www-data:www-data /var/www/html/storage
docker exec laravel_admin_app chmod -R 775 /var/www/html/storage

docker exec laravel_admin_app chown -R www-data:www-data /var/www/html/bootstrap/cache
docker exec laravel_admin_app chmod -R 775 /var/www/html/bootstrap/cache


sudo chown -R $(whoami):$(whoami) .

