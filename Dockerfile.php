FROM php:8.3-apache

RUN apt-get update && apt-get install -y git libzip-dev unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install zip mysqli pdo pdo_mysql

RUN composer global require squizlabs/php_codesniffer

COPY ./php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite