# ===============================
# Stage 1: Build
# ===============================
FROM php:8.2.27-cli-alpine3.21 AS builder
WORKDIR /app

RUN apk add --no-cache \
    libzip-dev libpq-dev libexif-dev \
    freetype-dev libjpeg-turbo-dev libpng-dev

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd bcmath zip exif pdo pdo_pgsql pcntl

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
RUN install-php-extensions gd bcmath zip exif pdo pdo_pgsql opcache pcntl redis

COPY --from=builder /app/vendor ./vendor
COPY --from=builder /app ./

RUN rm -f bootstrap/cache/*.php && \
    mkdir -p storage/logs storage/framework/{sessions,views,cache/data} && \
    chmod -R 777 storage bootstrap/cache

# Create startup script with detailed logging
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'set -e' >> /start.sh && \
    echo 'echo "==================================="' >> /start.sh && \
    echo 'echo "BeuXTrace Starting..."' >> /start.sh && \
    echo 'echo "==================================="' >> /start.sh && \
    echo 'echo "PHP Version:"' >> /start.sh && \
    echo 'php -v' >> /start.sh && \
    echo 'echo ""' >> /start.sh && \
    echo 'echo "PHP Extensions:"' >> /start.sh && \
    echo 'php -m | grep -E "(pdo|pgsql|zip|exif|gd|bcmath|pcntl|opcache|redis)"' >> /start.sh && \
    echo 'echo ""' >> /start.sh && \
    echo 'echo "Clearing caches..."' >> /start.sh && \
    echo 'php artisan config:clear' >> /start.sh && \
    echo 'php artisan cache:clear' >> /start.sh && \
    echo 'echo "Cache cleared!"' >> /start.sh && \
    echo 'echo ""' >> /start.sh && \
    echo 'echo "Starting server on 0.0.0.0:8080"' >> /start.sh && \
    echo 'echo "==================================="' >> /start.sh && \
    echo 'php artisan serve --host=0.0.0.0 --port=8080' >> /start.sh && \
    chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]