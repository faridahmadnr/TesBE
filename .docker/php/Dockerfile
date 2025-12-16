# ===============================
# Stage 1: Build dengan Composer
# ===============================
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

# Install dependency tanpa dev packages dan optimasi autoloader
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader --no-scripts --no-interaction

# Salin seluruh source code aplikasi
COPY . .

# ===============================
# Stage 2: Image Production PHP-FPM
# ===============================
FROM php:8.2.27-fpm-alpine3.21
WORKDIR /var/www

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
RUN install-php-extensions pdo pdo_pgsql opcache pcntl gd bcmath zip exif redis

# Salin hasil composer dari stage builder
COPY --from=builder /app/vendor ./vendor

# Salin seluruh source code aplikasi ke image production
COPY --from=builder /app ./

# Clean cache dan set permissions
RUN rm -f /var/www/bootstrap/cache/*.php && \
    chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

# Expose port (opsional, untuk dokumentasi)
EXPOSE 9000

CMD ["php-fpm"]