docker-compose down -v
docker-compose build --no-cache
docker-compose up -d
docker-compose up --build -d

root
    docker
        nginx
            default.conf
        php
            Dockerfile
    entrypoint.sh    
docker-composer.yml    

docker-compose exec app php artisan make:migration create_admins_table --create=admins
docker-compose exec app php artisan migrate
docker-compose exec app php artisan make:model Admin
docker-compose exec app php artisan make:controller Admin/Auth/LoginController
docker-compose exec app php artisan make:middleware AdminAuth



docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear

docker-compose exec app php artisan make:middleware RedirectIfAdminAuthenticated

docker-compose exec app php artisan make:seeder AdminSeeder
docker-compose exec app php artisan db:seed

docker-compose exec app php artisan migrate:fresh --seed
