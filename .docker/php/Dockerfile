# ===============================
# Stage 1: Build dengan Composer
# ===============================
FROM composer:2 AS builder

WORKDIR /app

# Salin file composer untuk instalasi dependency
COPY composer.json composer.lock ./

# Install dependency tanpa dev packages dan optimasi autoloader
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader

# Salin seluruh source code aplikasi
COPY . .

# ===============================
# Stage 2: Image Production PHP-FPM
# ===============================
FROM php:8.2.27-fpm-alpine3.21

WORKDIR /var/www/html

# Install apk packages we want
RUN apk add -Uuv \
    git bash supervisor freetype-dev libjpeg-turbo-dev libzip-dev libexif-dev $PHPIZE_DEPS nodejs npm \
    libpng-dev postgresql-dev nginx \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql opcache pcntl gd bcmath zip exif
RUN pecl install -o -f redis &&  rm -rf /tmp/pear
RUN docker-php-ext-enable redis exif

# Setup opcache
RUN docker-php-ext-configure opcache --enable-opcache
COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
    
# Salin hasil composer dari stage builder
COPY --from=builder /app/vendor ./vendor
# COPY .env.example .env

# Salin seluruh source code aplikasi ke image production
COPY --from=builder /app ./

RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Install wait-for-it
RUN curl https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh > /opt/wait-for-it.sh \
    && chmod +x /opt/wait-for-it.sh \
    && ln -s /opt/wait-for-it.sh /usr/bin/wait-for-it

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
