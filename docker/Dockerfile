FROM php:7.4.8-fpm

WORKDIR /var/www/html

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions pdo pdo_mysql gd zip exif

RUN docker-php-ext-install mysqli pdo pdo_mysql exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update

# Install xdebug
RUN pecl install xdebug-2.9.6
RUN docker-php-ext-enable xdebug