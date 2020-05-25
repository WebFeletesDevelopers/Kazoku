FROM php:7.4-fpm

RUN apt-get update -y && \
    apt-get install -y \
      $PHPIZE_DEPS \
      gettext \
      locales \
      libicu-dev \
      git \
      zip \
      libzip-dev && \
    rm -rf /var/lib/apt/lists/*

RUN echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen \
    && echo "es_ES.UTF-8 UTF-8" >> /etc/locale.gen \
    && locale-gen

RUN pecl install xdebug-2.9.4 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_mysql -j$(getconf _NPROCESSORS_ONLN)
RUN docker-php-ext-configure intl && docker-php-ext-install intl && docker-php-ext-install gettext
RUN docker-php-ext-install zip

COPY php/dev/php_config.ini /usr/local/etc/php/kazoku.ini
COPY php/dev/php_config.ini /usr/local/etc/php/conf.d/kazoku.ini
COPY php/dev/php_config.ini /etc/php7/conf.d/kazoku.ini

WORKDIR /src
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer global require hirak/prestissimo
