# Starting with Laravel and Docker

This repository is my starter kit for developing with Laravel and Docker. It's really basics, but you'll be able to start developing without getting bored with the installation of PHP, Nginx and MySQL.
This ships with **PHP 7.3-fpm**, **Nginx Alpine**, **MySQL 5.7** and **Memcached Alpine**.

## Requirements

* Docker engine v1.13 or higher. Your OS provided package might be a little old, if you encounter problems, do upgrade. See [https://docs.docker.com/engine/installation](https://docs.docker.com/engine/installation)
* Docker compose v1.12 or higher. See [docs.docker.com/compose/install](https://docs.docker.com/compose/install/)

## Getting Started

First, clone this repository or just download it.

````
$ git clone https://github.com/diego-rlima/laravel-docker.git app-folder
````

After, install the Laravel dependencies with Composer.

````
$ cd ./app-folder
$ docker run --rm -v $(pwd):/app composer install
````

Set the permissions on the project folder.

````
$ sudo chown -R $USER:$USER /path/to/app-folder
````

Create the .env file.

````
$ cp .env.example .env
````

Edit the .env file end put the default admin user info.

````
$ nano .env

DEFAULT_ADMIN_NAME=
DEFAULT_ADMIN_EMAIL=
DEFAULT_ADMIN_PASSWORD=
````

Finally, inside the project folder, just run:

````
$ docker-compose up -d
````

You can check if the containers are running

````
$ docker ps
````

If is everything ok, it will output something like:

````
CONTAINER ID        IMAGE                COMMAND                  CREATED             STATUS              PORTS                                         NAMES
de320d716e6c        mysql:5.7            "docker-entrypoint.s…"   2 minutes ago   2 minutes ago    33060/tcp, 0.0.0.0:8002->3306/tcp             laravel-docker-mysql
c3fafc29c50f        nginx:alpine         "nginx -g 'daemon of…"   2 minutes ago   2 minutes ago    0.0.0.0:8000->80/tcp, 0.0.0.0:8443->443/tcp   laravel-docker-nginx
42f663b922c0        memcached:alpine     "docker-entrypoint.s…"   2 minutes ago   2 minutes ago    11211/tcp                                     phpdocker-memcached
a53498ca08b6        laravel-docker_app   "/bin/sh -c /usr/bin…"   2 minutes ago   2 minutes ago    9000/tcp                                      laravel-docker-app
````

Next, set the the `APP_KEY` and the `JWT_SECRET` for the Laravel application.

````
$ docker-compose exec app php artisan key:generate
$ docker-compose exec app php artisan jwt:secret
````

Run the migrations.

````
$ docker-compose exec app php artisan migrator
````

**Note:** For this, the [Migrator package](https://github.com/artesaos/migrator) is used instead of the standard migrations.

### Docker compose cheatsheet

Inside your **app-folder**, you can use any of the following commands:

* Start containers in the background: `docker-compose up -d`
* Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
* Stop containers: `docker-compose stop`
* Kill containers: `docker-compose kill`
* View container logs: `docker-compose logs`
* Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. Examples:
    * Shell into the PHP container, `docker-compose exec php-fpm bash`
    * Run symfony console, `docker-compose exec php-fpm bin/console`
    * Open a mysql shell, `docker-compose exec mysql mysql -uroot -pCHOSEN_ROOT_PASSWORD`

## Accessing the Application

You can access your application via **`localhost`**, if you're running the containers directly, or through **``** when run on a vm. nginx and mailhog both respond to any hostname, in case you want to add your own hostname on your `/etc/hosts` 

Service|Address outside containers
------|---------
Application|[localhost:8000](http://localhost:8000)
Database|**host:** `localhost`; **port:** `8002`

The default database name, user, and password are, respectively, `laravel`, `root` and `secret`.

## Hosts within your environment

You'll need to configure your application to use any services you enabled:

Service|Hostname|Port number
------|---------|-----------
php-fpm|php-fpm|9000
MySQL|mysql|3306 (default)
Memcached|memcached|11211 (default)

## License

Like Laravel, this repository is licensed under the [MIT license](https://opensource.org/licenses/MIT).
