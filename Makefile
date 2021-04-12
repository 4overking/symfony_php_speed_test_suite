APP_CONTAINER_NAME := php

docker_bin := $(shell command -v docker 2> /dev/null)
docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)

up: ## Start all containers (in background) for development
	$(docker_compose_bin) up -d --build

down: ## Stop all started for development containers
	$(docker_compose_bin) down

restart: ## Restart all started for development containers
	$(docker_compose_bin) restart

console: ## Symfony console
	$(docker_compose_bin) exec $(APP_CONTAINER_NAME) bash
