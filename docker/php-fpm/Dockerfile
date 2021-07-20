FROM arquivei/php:7.4-fpm-alpine

COPY php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini

WORKDIR /application

RUN set -eux; \
    apk --update add \
    autoconf \
    g++ \
    gcc \
    make \
    zlib-dev \
    autoconf \
    build-base \
    git \
    openssh; \
    pecl install xdebug; \
    echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo "xdebug.start_with_request=1" >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo "xdebug.idekey=phpstorm-docker" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
