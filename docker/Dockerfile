FROM php:8.0-fpm 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y \
    git zip unzip nodejs npm\
&& docker-php-ext-install pdo_mysql