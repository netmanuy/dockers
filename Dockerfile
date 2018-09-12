FROM php:7.2-apache
LABEL maintainer="Sebastian Delgado (netman) netmanzion@gmail.com"

# Copy source code into html folder
COPY src/ /var/www/html/

# Create temporal file and setup apache permission
RUN mkdir -p /var/www/html/tmp && chown www-data.www-data /var/www/html/tmp 

# Update Image and install ImageMagick
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends
RUN pecl install imagick && docker-php-ext-enable imagick

# Install GD
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
    #&& docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Clean Installation files
RUN apt-get clean alll

# Remove not necessary files
RUN rm -rf /var/lib/apt/lists/*
