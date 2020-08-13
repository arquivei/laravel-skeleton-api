# Replace it for .env after running make setup
-include .env

##############################
## Application              ##
##############################

setup:
	./scripts/setup.sh
	make build composer-install up

up:
	@docker-compose up -d

build:
	@docker-compose build

stop:
	@docker-compose stop

restart:
	@docker-compose restart

logs:
	@docker-compose logs -f

php:
	@docker-compose exec php-fpm sh

clear:
	@docker-compose exec php-fpm \
	    php artisan cache:clear \
	    && php artisan route:clear \
	    && php artisan config:clear \
	    && php artisan view:clear

##############################
## Quality                  ##
##############################

check: phpstan phpcs phpunit coverage

phpstan:
	docker run -it --rm \
		--entrypoint ./vendor/bin/phpstan \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm \
		analyse core app

phpcs:
	docker run -it --rm \
		--entrypoint ./vendor/bin/phpcs \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm \
		core app --standard=PSR12 -p

phpcbf:
	docker run -it --rm \
		--entrypoint ./vendor/bin/phpcbf \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm \
		core app --standard=PSR12 -p

phpunit:
	docker run -it --rm \
		--entrypoint ./vendor/bin/phpunit \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm \
		tests

coverage:
	docker run -it --rm \
		--entrypoint ./vendor/bin/phpunit \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm \
		--whitelist tests/ \
		--coverage-html storage/tests/coverage/

##############################
## COMPOSER                 ##
##############################

composer:
	docker run -it --rm \
		--entrypoint /bin/sh \
		-e COMPOSER_AUTH=${COMPOSER_AUTH} \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm

composer-install:
	docker run -it --rm \
		--entrypoint composer \
		-e COMPOSER_AUTH=${COMPOSER_AUTH} \
		--volume ${PWD}:/application \
		--workdir /application \
		${APP_IDENTIFIER}_php-fpm \
		install --ignore-platform-reqs
