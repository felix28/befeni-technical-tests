docker stop calculator-app
docker stop calculator-nginx
docker rm calculator-app
docker rm calculator-nginx
docker image prune -f