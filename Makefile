build-dev:
	docker-compose -f docker-compose-dev.yml pull
	docker-compose -f docker-compose-dev.yml build

start-dev: build-dev
	docker-compose -f docker-compose-dev.yml up -d