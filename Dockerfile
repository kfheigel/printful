FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
    unzip \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install mbstring xml zip \
    && apt-get clean

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app