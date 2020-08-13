# Laravel Skeleton API

Base project for Web APIs using Laravel

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
```

## 
