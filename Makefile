include .env

up: docker-up
down: docker-down
restart: down up
init: docker-down docker-pull docker-build docker-up backend-init
backend-init: backend-env composer-install key-generate wait-db migrate-refresh swagger

docker-up:
	docker-compose up -d
docker-down:
	docker-compose down --remove-orphans
docker-clear-volumes:
	docker-compose down --remove-orphans -v
docker-pull:
	docker-compose pull
docker-build:
	docker-compose build

composer-install:
	docker-compose run --rm php-cli composer install
backend-env:
	docker-compose run --rm php-cli cp .env.example .env
key-generate:
	docker-compose run --rm php-cli php artisan key:generate
wait-db:
	until docker-compose exec -T postgres pg_isready --timeout=0 --dbname=app ; do sleep 1; done
create-test-db:
	docker-compose exec -T postgres psql -U '${POSTGRES_USER}' '${POSTGRES_DB}' -tc "SELECT 1 FROM pg_database WHERE datname = 'test_db_test'" | grep -q 1 || \
	docker-compose exec -T postgres psql -U '${POSTGRES_USER}' '${POSTGRES_DB}' -c "CREATE DATABASE test_db_test"
migrate:
	docker-compose run --rm php-cli php artisan migrate
migrate-refresh:
	docker-compose run --rm php-cli php artisan db:wipe
	docker-compose run --rm php-cli php artisan migrate:refresh --seed
test:
	make create-test-db
	docker-compose run --rm php-cli php artisan test
swagger:
	docker-compose run --rm php-cli php ./vendor/bin/openapi -f json -o swagger.json app
pint-test:
	docker-compose run --rm php-cli php vendor/bin/pint --test
pint-fix:
	docker-compose run --rm php-cli php vendor/bin/pint
ide-generate:
	docker-compose run --rm php-cli php artisan ide-helper:generate
	docker-compose run --rm php-cli php artisan ide-helper:models -N
	docker-compose run --rm php-cli php artisan ide-helper:meta
