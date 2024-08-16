# Dockerfile

FROM php:8.1.6
RUN apt-get update -y && \
    apt-get install -y openssl zip unzip git libpq-dev libzip-dev libonig-dev
RUN docker-php-ext-install pdo pdo_mysql mbstring
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
