run: build up composer-install cache-clear seed
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

cache-clear:
	docker exec -it app bin/console cache:clear

unit-tests:
	docker exec -it app ./bin/phpunit -c phpunit.xml --testdox --testsuite unit
