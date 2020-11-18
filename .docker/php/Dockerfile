FROM php:7.4-fpm-alpine
MAINTAINER Nick Tsubanov

RUN set -ex \
  && apk --no-cache add \
    mariadb-dev
#        libmcrypt-dev \
#        libgmp-dev \
#        libxml2-dev \
#        curl \
#        zlib1g-dev \
#        libncurses5-dev \
#        libldap2-dev \
#        libicu-dev \
#        libmemcached-dev \
#        libcurl4-openssl-dev \
#        ssmtp \
#        cron \
#        libpq-dev
#
RUN apk add libsodium-dev  icu-dev libzip-dev zip
RUN docker-php-ext-install pdo pdo_mysql
#RUN docker-php-ext-install intl
#RUN docker-php-ext-install zip
RUN docker-php-ext-enable pdo pdo_mysql
RUN docker-php-ext-install bcmath sodium exif intl zip
RUN apk --no-cache update \
    && apk --no-cache upgrade \
    && apk add --no-cache $PHPIZE_DEPS \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) gd
#RUN docker-php-ext-configure intl
#
#
#
#ENV TERM xterm
#
RUN apk add mc

RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
RUN php composer-setup.php
RUN mv composer.phar /bin/composer
RUN chmod a+x /bin/composer
RUN php -r "unlink('composer-setup.php');"
RUN composer global require "fxp/composer-asset-plugin:^1.4.4"
RUN apk add git
WORKDIR /app
#RUN composer install

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
#
#
#
## Memcached
## TODO PECL not available for PHP 7 yet, we must compile it.
#RUN apt-get update \
#    && apt-get install -y \
#    libmemcached-dev \
#    libmemcached11
#
#
#WORKDIR /app
#
## Supervisor
#RUN apt-get update &&\
#    apt-get install -y --no-install-recommends \
#        supervisor
#
##RUN apt-get install net-tools -y
#
#COPY supervisord.d/supervisord.conf /etc/supervisor
##COPY supervisord.d/supervisord.conf /etc/supervisor
#COPY supervisord.d/workers/* /etc/supervisor/conf.d/
#
#
#
#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
##/usr/bin/supervisord -c /etc/supervisor/supervisord.conf