up: docker-up
down: docker-down
restart: docker-down docker-up
test-unit: social-test-unit
test-unit-coverage: social-test-unit-coverage

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build
