FROM php:8.4-apache

ARG USER=dev

# APACHE CONFIGURATION
COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# PHP CONFIGURATION
COPY php/php.ini /usr/local/etc/php/conf.d/web.ini

# APACHE EXTENSIONS
RUN a2enmod rewrite
RUN a2enmod headers

# SYSTEM USER
RUN groupadd ${USER} -g 1000 \
    && useradd ${USER} -g ${USER} -d /home/${USER} -m -ms /bin/bash