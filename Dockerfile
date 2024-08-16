# Dockerfile

FROM php:8.1-fpm
RUN apt-get update -y && \
    apt-get install -y mysql-server openssl zip unzip git libpq-dev libzip-dev libonig-dev
# RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-install pdo_mysql zip exif pcntl
# RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
    
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring
WORKDIR /var/www
COPY . /var/www
RUN composer require
CMD php artisan migrate & php artisan serve --host=0.0.0.0 
EXPOSE 8000
