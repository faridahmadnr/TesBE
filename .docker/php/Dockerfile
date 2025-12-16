# ===============================
# Stage 1: Build
# ===============================
FROM php:8.2.27-cli-alpine3.21 AS builder
WORKDIR /app

RUN apk add --no-cache \
    libzip-dev libpq-dev libexif-dev \
    freetype-dev libjpeg-turbo-dev libpng-dev

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd bcmath zip exif pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader --no-scripts --no-interaction

COPY . .

# ===============================
# Stage 2: Production
# ===============================
FROM php:8.2.27-cli-alpine3.21

WORKDIR /var/www

RUN apk add --no-cache \
    freetype libjpeg-turbo libzip libpq libexif libpng bash

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd bcmath zip exif pdo pdo_pgsql opcache redis

COPY --from=builder /app/vendor ./vendor
COPY --from=builder /app ./

RUN rm -f bootstrap/cache/*.php && \
    mkdir -p storage/logs storage/framework/{sessions,views,cache/data} && \
    chmod -R 777 storage bootstrap/cache

# Create startup script
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'echo "=== BeuXTrace Starting ==="' >> /start.sh && \
    echo 'echo "Port: 8080"' >> /start.sh && \
    echo 'php artisan config:clear' >> /start.sh && \
    echo 'php artisan cache:clear' >> /start.sh && \
    echo 'echo "Starting Laravel..."' >> /start.sh && \
    echo 'php artisan serve --host=0.0.0.0 --port=8080' >> /start.sh && \
    chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]