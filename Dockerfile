FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install
COPY php.ini /usr/local/etc/php/conf.d/
RUN chmod -R gu+w storage
RUN chmod -R guo+w storage

RUN mkdir -p /var/www/html/storage/framework/views \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
