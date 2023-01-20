FROM php:8.0.11-apache
RUN apt-get update && apt-get install -y apt-utils libpq-dev libxml2-dev git zip unzip libicu-dev libbz2-dev libpng-dev libjpeg-dev \
libmcrypt-dev libreadline-dev libfreetype6-dev g++ imagemagick vim nano
RUN apt-get update && apt-get install -y \
        freetds-bin \
        freetds-dev \
        freetds-common \
        libct4 \
        libsybdb5 \
        tdsodbc \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libldap2-dev \
        libc-client-dev
RUN ln -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/
RUN docker-php-ext-install soap gd intl pdo pdo_dblib
RUN apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD ./000-default.conf /etc/apache2/sites-enabled/000-default.conf
ADD ./php.ini /usr/local/etc/php/php.ini
