FROM php:7.2-fpm
WORKDIR /var/www
RUN apt-get update \
    && apt-get install -y \
        libfreetype6-dev \
        git-all \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libmemcached-dev \
        libpng-dev \
        libpq-dev \
        zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mbstring pdo pdo_mysql pdo_pgsql zip \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"
