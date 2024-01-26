FROM php:7.4-apache
COPY images/ /var/www/html/images/

RUN docker-php-ext-install pdo_mysql
