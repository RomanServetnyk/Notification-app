# Dockerfile

FROM php:8.1-fpm
RUN apt-get update -y && \
    apt-get install -y openssl zip unzip git libpq-dev libzip-dev libonig-dev php8.1-mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring
WORKDIR /var/www
COPY . /var/www
RUN composer require
CMD php artisan migrate & php artisan serve --host=0.0.0.0 
EXPOSE 8000
