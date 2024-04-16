build:
	# sudo chmod -R 755 src/
	docker compose up -d

start:
	docker compose start

stop:
	docker compose stop

apache_logs:
	docker compose logs apache

php_logs:
	docker compose logs php

mysql_logs:
	docker compose logs mariadb
