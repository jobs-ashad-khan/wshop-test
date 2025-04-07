FROM php:8.4-apache

ARG USER=dev

# GLOBAL INSTALLATION
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip

# APACHE CONFIGURATION
COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN a2enmod headers

# PHP CONFIGURATION
COPY php/php.ini /usr/local/etc/php/conf.d/web.ini

# SYMFONY & COMPOSER INSTALLATION
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# SYSTEM USER
RUN groupadd ${USER} -g 1000 \
    && useradd ${USER} -g ${USER} -d /home/${USER} -m -ms /bin/bash