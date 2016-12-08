FROM php:5.6-apache

RUN docker-php-ext-install mysql
RUN docker-php-ext-install mbstring
RUN a2enmod rewrite

COPY php.ini /usr/local/etc/php/

VOLUME /var/www/html
