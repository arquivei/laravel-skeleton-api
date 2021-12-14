FROM composer AS Builder

ARG COMPOSER_AUTH
ARG COMPOSER_ARGS="-o --no-dev --ignore-platform-reqs --no-scripts"

WORKDIR /application

COPY . /application

RUN composer install $COMPOSER_ARGS

FROM arquivei/php:8.1-fpm-alpine

WORKDIR /application

COPY --from=Builder /application /application
