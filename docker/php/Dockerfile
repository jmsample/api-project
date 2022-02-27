FROM php:8.1-fpm

# Update the package lists
RUN apt-get update

# Standard package installations
RUN apt-get install apt-utils vim htop git curl wget zip unzip -y

# PHP extension requirment: gd
RUN apt-get install libpng-dev -y

# Install required PHP extensions
RUN docker-php-ext-install bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the phpinfo() file
RUN mkdir /var/www/php
COPY ./php/php-info.php /var/www/php

# Create the PHP log dir
RUN mkdir /var/log/php
RUN chmod 757 /var/log/php

# Set the working dir
WORKDIR /app
