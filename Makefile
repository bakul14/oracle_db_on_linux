.PHONY: up down

all: help

help:
	@echo "Использование: make {up|down}"
	@echo "Команды:"
	@echo "  up - Запускает систему"
	@echo "  down  - Останавливает систему"

up:
	@echo "Система запускается..."
	mkdir -p data
	chmod a+rw data
	docker compose up --build --force-recreate

down:
	@echo "Система останавливается..."
	docker compose down

# Обработка неизвестной команды
%:
	@echo "Неизвестная команда: $@"
	@echo "Использование: make {up|down}"
