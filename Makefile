build-dev:
	docker-compose -f docker-compose-dev.yml pull
	docker-compose -f docker-compose-dev.yml build
	docker-compose -f docker-compose-dev.yml run --rm php-fpm composer install

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
