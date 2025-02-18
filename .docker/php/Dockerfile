FROM php:8.2.27-fpm-alpine3.21

WORKDIR /opt

COPY .env.example .env

# Install apk packages we want
RUN apk add -Uuv \
    git bash supervisor freetype-dev libjpeg-turbo-dev libzip-dev libexif-dev $PHPIZE_DEPS nodejs npm \
    libpng-dev postgresql-dev nginx \
    && rm -rf /var/cache/apk/*

# Install wait-for-it
RUN curl https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh > /opt/wait-for-it.sh \
    && chmod +x /opt/wait-for-it.sh \
    && ln -s /opt/wait-for-it.sh /usr/bin/wait-for-it

# Download and install composer
ARG COMPOSER_COMMIT_HASH=da7be05fa1c9f68b9609726451d1aaac7dd832cb
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/${COMPOSER_COMMIT_HASH}/web/installer -O - -q | php -- --quiet
RUN chmod +x /opt/composer.phar \
    && ln -s /opt/composer.phar /usr/bin/composer

# Install PHP extensions
# ENV PHPREDIS_VERSION 5.3.2
# COPY .docker/php/install-extensions.sh /opt/install-extensions.sh
# RUN /opt/install-extensions.sh

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql opcache pcntl gd bcmath zip exif
RUN pecl install -o -f redis &&  rm -rf /tmp/pear
RUN docker-php-ext-enable redis exif

# Setup opcache
RUN docker-php-ext-configure opcache --enable-opcache
COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
