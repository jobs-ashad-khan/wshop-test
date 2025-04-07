up:
	docker compose -f ./docker-compose.yml up -d --build

down:
	docker compose -f ./docker-compose.yml down

restart:
	docker compose -f ./docker-compose.yml restart

api:
	docker exec -u dev -it wshop_api_store bash

log-apache:
	docker logs -f wshop_api_store