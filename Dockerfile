FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
    unzip && \
    apt-get clean

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app