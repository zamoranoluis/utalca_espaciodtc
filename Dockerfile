FROM php:8.2-fpm

# Actualiza apt y instala dependencias necesarias para GD y otros paquetes
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Añadir el instalador de extensiones PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Hacer el instalador ejecutable
RUN chmod +x /usr/local/bin/install-php-extensions

# Instalar la extensión GD usando el script
RUN install-php-extensions gd

# Instalar las extensiones PHP necesarias adicionales
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath

# Copiar el archivo de Composer y demás configuraciones
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar los archivos de tu aplicación
COPY . .

# Instalar dependencias de Composer
RUN composer install

# Copiar el archivo php.ini
COPY php.ini /usr/local/etc/php/conf.d/

# Dar permisos a los directorios de almacenamiento
RUN chmod -R gu+w storage
RUN chmod -R guo+w storage

RUN mkdir -p /var/www/html/storage/framework/views \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
