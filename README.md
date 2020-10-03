# Laravel Skeleton API

Base project for Web APIs using Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arquivei/laravel-skeleton-api.svg?style=flat-square)](https://packagist.org/packages/arquivei/laravel-skeleton-api)
[![Total Downloads](https://img.shields.io/packagist/dt/arquivei/laravel-skeleton-api.svg?style=flat-square)](https://packagist.org/packages/arquivei/laravel-skeleton-api)

## Requirements

+ Composer
+ Git
+ docker-composer 1.26+

## Starting a New API

```shell script
composer create-project arquivei/laravel-skeleton-api my-awesome-api
```
Or

```shell script
docker run --rm -it -v $PWD:/app composer create-project arquivei/laravel-skeleton-api my-awesome-api
```

Edit `.env.dist`

+ APP_IDENTIFIER=<NEW-API-NAME>
+ COMPOSER_AUTH=

```shell script
make setup

sudo chmod -r 777 storage/
```

## Access

```shell script
curl --header 'x-traceid: a5d112fe87eb473baee742f1328dfc9a' '127.0.0.1:5080/api/v1/test'
```
