docker stop shirt-order-app
docker stop shirt-order-phpmyadmin
docker stop shirt-order-nginx
docker stop shirt-order-mysql
docker rm shirt-order-app
docker rm shirt-order-phpmyadmin
docker rm shirt-order-nginx
docker rm shirt-order-mysql
docker image prune -f