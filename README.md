# Laravel Skeleton API

Base project for REST API using Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arquivei/laravel-skeleton-api.svg?style=flat-square)](https://packagist.org/packages/arquivei/laravel-skeleton-api)
[![Total Downloads](https://img.shields.io/packagist/dt/arquivei/laravel-skeleton-api.svg?style=flat-square)](https://packagist.org/packages/arquivei/laravel-skeleton-api)

## Requirements

+ PHP 8.1+
+ Composer
+ Git
+ Docker Engine 17.09.0+
+ docker-composer 1.26+

## Creating a new API

```shell script
composer create-project arquivei/laravel-skeleton-api my-api
```
or
```shell script
docker run -it --rm -v $PWD:/app composer create-project arquivei/laravel-skeleton-api my-api
```

Edit `.env`

+ APP_IDENTIFIER=<NEW-API-NAME>
+ COMPOSER_AUTH=

```shell script
make setup

sudo chmod -R 777 storage/
```

## Accessing the test endpoint

```shell script
curl --header 'x-traceid: a5d112fe87eb473baee742f1328dfc9a' '127.0.0.1:5080/api/v1/test'
```
