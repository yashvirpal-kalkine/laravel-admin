docker-compose down -v
docker-compose build --no-cache
docker-compose up -d


root
    docker
        nginx
            default.conf
        php
            Dockerfile
    entrypoint.sh    
docker-composer.yml    