build-dev:
	docker-compose -f docker-compose-dev.yml pull
	docker-compose -f docker-compose-dev.yml build

start-dev: build-dev
	docker-compose -f docker-compose-dev.yml up -d

stop-dev:
	docker-compose -f docker-compose-dev.yml down

remove-data:
	docker-compose -f docker-compose-dev.yml down -v

daily-up: remove-data start-dev
