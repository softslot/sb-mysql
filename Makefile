init-project: docker-down-clear docker-pull docker-build docker-up

docker-down-clear:
	docker compose down -v --remove-orphans

docker-pull:
	docker compose pull

docker-build:
	docker compose build

docker-up:
	docker compose up -d

docker-down:
	docker compose down

composer-install:
	docker compose exec app composer install

migrate: wait-db migrate-app

wait-db:
	until docker compose exec -T database mysqladmin ping -h localhost --silent; do sleep 1 ; done

migrate-app:
	docker compose exec app ./bin/console d:m:m --no-interaction

check: lint analyze test

lint:
	docker compose exec app ./vendor/bin/phpcbf && \
	docker compose exec app ./bin/console lint:twig templates

analyze:
	docker compose exec app ./vendor/bin/phpstan analyse src tests

test:
	docker compose exec app ./bin/phpunit
