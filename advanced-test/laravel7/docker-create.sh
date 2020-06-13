rm .env
cp .env.example .env
sudo rm -r vendor
docker image prune -f
docker network prune
docker run --rm -v $(pwd):/app composer install
sudo chown -R $USER:$USER .
docker-compose up -d
docker-compose exec shirt-order-app php artisan --version
docker-compose exec shirt-order-app php artisan key:generate
docker-compose exec shirt-order-app php artisan config:cache
docker-compose exec shirt-order-app php artisan config:clear
docker ps -a
php artisan test