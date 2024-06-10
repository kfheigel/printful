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

request:
	docker exec -it app php bin/StartCommand.php

sleep:
	sleep 5

test:
	docker exec -it app vendor/bin/phpunit --testdox --testsuite unit
