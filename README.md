# Laravel Skeleton API

Base project for Web APIs using Laravel

## Requirements

+ Git
+ docker-composer 1.26+

## Starting a New API

```shell script
git clone git@github.com:arquivei/laravel-skeleton-api.git <NEW-API-NAME>

cd <NEW-API-NAME>

chmod -Rf 0777 "${PWD}/storage"
```

Edit `.env.dist`

+ APP_IDENTIFIER=<NEW-API-NAME>
+ COMPOSER_AUTH=

```shell script
make setup
```

## 
