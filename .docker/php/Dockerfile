# ===============================
# Stage 1: Build dengan Composer
# ===============================
FROM composer:latest AS builder

FROM php:8.2.27-fpm-alpine3.21 AS builder
WORKDIR /app

# Install dependencies yang diperlukan untuk build
RUN apk add --no-cache \
    git \
    libzip-dev \
    libpq-dev \
    libexif-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev

# Install PHP extensions
COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd bcmath zip exif pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file composer untuk instalasi dependency
COPY composer.json composer.lock ./

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd bcmath zip exif
RUN docker-php-ext-enable exif
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip exif pdo_pgsql \
    && docker-php-ext-enable zip exif
# Install dependency tanpa dev packages dan optimasi autoloader
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader --no-scripts
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader --no-scripts --no-interaction

# Salin seluruh source code aplikasi
COPY . .

# ===============================
# Stage 2: Image Production PHP-FPM
# ===============================
FROM php:8.2.27-fpm-alpine3.21

WORKDIR /var/www

# Install apk packages we want
RUN apk add -Uuv \
    git bash supervisor freetype-dev libjpeg-turbo-dev libzip-dev libpq-dev libexif-dev $PHPIZE_DEPS \
    libpng-dev \
    && rm -rf /var/cache/apk/*
# Install runtime packages
RUN apk add --no-cache \
    bash \
    supervisor \
    freetype \
    libjpeg-turbo \
    libzip \
    libpq \
    libexif \
    libpng

# Install PHP extensions
COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo pdo_pgsql opcache pcntl gd bcmath zip exif
RUN docker-php-ext-enable exif
RUN install-php-extensions pdo pdo_pgsql opcache pcntl gd bcmath zip exif redis

# Setup opcache
# RUN docker-php-ext-configure opcache --enable-opcache
# COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
    
# Salin hasil composer dari stage builder
COPY --from=builder /app/vendor ./vendor
# COPY .env.example .env

# Salin seluruh source code aplikasi ke image production
COPY --from=builder /app ./

RUN rm -f /var/www/bootstrap/cache/*.php
# Clean cache dan set permissions
RUN rm -f /var/www/bootstrap/cache/*.php && \
    chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache
# Expose port (opsional, untuk dokumentasi)
EXPOSE 9000

RUN ls -lh
# Install wait-for-it
# RUN curl https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh > /opt/wait-for-it.sh \
#     && chmod +x /opt/wait-for-it.sh \
#     && ln -s /opt/wait-for-it.sh /usr/bin/wait-for-it
CMD ["php-fpm"]