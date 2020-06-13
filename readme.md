<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Pre-requisites:
- Docker
- Make sure these ports are available: 7008, 7009, 7010, 7011, 7012, 7013 and 8089 or change them for your convenience.
- (Optional) Install dos2unix: sudo apt-get install dos2unix

## Instruction to run Basic Test Back-end in Docker Container:
- After cloning this repository, go to project's directory: cd /directory/of/this/project/basic-test/basic-test-server
- Make sure the value of APP_URL variable in .env.example file is http://localhost:7009. This is the same port number you set in creating calculator-nginx container.
- sudo chown -R $USER:$USER /directory/of/this/project/basic-test/basic-test-server
- (Optional) sudo dos2unix docker-create.sh
- (Optional) sudo dos2unix docker-destroy.sh
- (Optional) sudo chmod +x docker-create.sh
- (Optional) sudo chmod +x docker-destroy.sh
- Create the app by running this command: ./docker-create.sh
- Destroy the app by running this command: ./docker-destroy.sh
- If there are failed tests while running ./docker-create.sh, you can destroy by running the ./docker-destroy.sh
- Check if all containers are running by executing: docker ps
- Declare this command to see if all test passed: php artisan test
- Visit <a href="http://localhost:7009" target="_blank">http://localhost:7009</a> for Laravel

## Instruction to run Basic Test Front-end in Docker Container:
- After cloning this repository, go to project's directory: cd /directory/of/this/project/basic-test/basic-test-client
- Make sure the value of apiURL variable in src/plugins/axios.js is http://localhost:7009. This is the same port number you set in creating calculator-nginx container.
- Create the app by running this command: ./docker-create.sh
- Destroy the app by running this command: ./docker-destroy.sh
- Visit <a href="http://localhost:8089" target="_blank">http://localhost:8089</a> for Vue.JS

## Instruction to run Advanced Test in Docker Container:
- After cloning this repository, go to project's directory: cd /directory/of/this/project/advanced-test/laravel7
- Make sure the value of APP_URL variable in .env.example file is http://localhost:7011. This is the same port number you set in creating shirt-order-nginx container.
- sudo chown -R $USER:$USER /directory/of/this/project/advanced-test/laravel7
- (Optional) sudo dos2unix docker-create.sh
- (Optional) sudo dos2unix docker-destroy.sh
- (Optional) sudo chmod +x docker-create.sh
- (Optional) sudo chmod +x docker-destroy.sh
- Create the app by running this command: ./docker-create.sh
- Destroy the app by running this command: ./docker-destroy.sh
- Check if all containers are running by executing: docker ps
- Visit <a href="http://localhost:7011" target="_blank">http://localhost:7011</a> for Laravel.
- Visit <a href="http://localhost:7013" target="_blank">http://localhost:7013</a> for phpMyAdmin.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).