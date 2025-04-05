up:
	docker compose -f ./docker-compose.yml up -d --build

down:
	docker compose -f ./docker-compose.yml down

web:
	docker exec -u dev -it wshop_web bash

log-apache:
	docker logs -f wshop_web
