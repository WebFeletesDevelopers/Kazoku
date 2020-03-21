FROM php:7.3-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS

RUN docker-php-ext-install pdo pdo_mysql -j$(getconf _NPROCESSORS_ONLN)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY cfg/php/prod/php_config.ini /usr/local/etc/php/kazoku.ini
COPY cfg/php/prod/php_config.ini /usr/local/etc/php/conf.d/kazoku.ini
COPY cfg/php/prod/php_config.ini /etc/php7/conf.d/kazoku.ini

COPY . /code
