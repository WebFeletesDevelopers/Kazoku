build-dev:
	docker-compose -f docker-compose-dev.yml pull
	docker-compose -f docker-compose-dev.yml build
	make install-deps

start-dev: build-dev
	docker-compose -f docker-compose-dev.yml up -d

stop-dev:
	docker-compose -f docker-compose-dev.yml down

remove-data:
	docker-compose -f docker-compose-dev.yml down -v

daily-up: remove-data start-dev

build:
	sh ./cfg/scripts/build-and-push.sh
	docker-compose pull

start:
	docker-compose up -d

install-deps:
	docker-compose -f docker-compose-dev.yml run --rm php-fpm composer install ${args}

update-deps:
	docker-compose -f docker-compose-dev.yml run --rm php-fpm composer update ${args}

require-deps:
	docker-compose -f docker-compose-dev.yml run --rm php-fpm composer require ${args}

create-pot:
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm bash -c "find . -name '*.php' ! -path './vendor/*' ! -path './locale/*' > potfiles"
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm bash -c "xgettext --from-code=UTF-8 -o locale/kazoku.pot --files-from=potfiles --add-comments"
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm rm potfiles

update-po: create-pot create-twig-translation-cache
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm bash -c "msgmerge --update locale/en_US/LC_MESSAGES/kazoku.po locale/kazoku.pot"
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm bash -c "msgmerge --update locale/es_ES/LC_MESSAGES/kazoku.po locale/kazoku.pot"
	@make delete-translation-cache

delete-translation-cache:
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm rm -rf locale/kazoku.pot View/cache

compile-mo-dev:
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm bash -c "msgfmt locale/en_US/LC_MESSAGES/kazoku.po --output=locale/en_US/LC_MESSAGES/kazoku.mo"
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm bash -c "msgfmt locale/es_ES/LC_MESSAGES/kazoku.po --output=locale/es_ES/LC_MESSAGES/kazoku.mo"

create-twig-translation-cache:
	@docker-compose -f docker-compose-dev.yml run --rm php-fpm php locale/generate_twig_cache.php
