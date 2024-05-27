run: build up composer-install
test: unit-tests 

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

bash:
	docker exec -it app /bin/bash

composer-install:
	docker exec -it app composer install

sleep:
	sleep 5

unit-tests:
	docker exec -it app vendor/bin/phpunit --testdox --testsuite unit
