FROM php:7.3-fpm-alpine

RUN apk add libressl-dev

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && echo "extension=mongodb.so" >> php --ini