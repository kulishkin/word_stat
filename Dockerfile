FROM php:7.4-alpine3.12

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
RUN apk update && apk upgrade && apk add bash

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN wget -O /usr/local/bin/php-cs-fixer https://cs.symfony.com/download/php-cs-fixer-v2.phar && chmod +x /usr/local/bin/php-cs-fixer

RUN apk add git

ENV XDEBUG_IDEKEY IDEBUG

RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini