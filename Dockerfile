FROM ubuntu:20.04

# Set environment variables
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    apt-utils \
    software-properties-common \
    nano \
    curl \
    gnupg2 \
    lsb-release \
    unzip \
    git

# Install PHP and extensions
RUN add-apt-repository ppa:ondrej/php -y && \
    apt-get update && apt-get install -y \
    php8.1 \
    php8.1-cli \
    php8.1-mysql \
    php8.1-pgsql \
    php8.1-sqlite3 \
    php8.1-redis \
    php8.1-curl \
    php8.1-json \
    php8.1-zip \
    php8.1-bcmath \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-tokenizer \
    php8.1-gd \
    libpng-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents to the working directory
COPY . /var/www

# Install application dependencies
RUN composer install --no-interaction

# Expose port 8000 and start PHP built-in server
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
