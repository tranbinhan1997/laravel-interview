FROM php:8.2-fpm-alpine

# php:8.2-fpm-alpine already included: json, mysqlnd, curl, xml, mbstring

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN apk add php-xml
RUN apk add php-xmlwriter
RUN apk add php-dom
RUN apk add php-tokenizer
RUN apk add php-intl
RUN apk add php-gd

# Install composer
RUN apk add --no-cache curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN apk add icu-dev
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# gd
RUN apk add --no-cache libjpeg-turbo-dev libpng-dev libwebp-dev freetype-dev

# As of PHP 7.4 we don't need to add --with-png
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd

RUN apk add bash
RUN apk add composer