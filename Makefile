build: 
	docker build -t jose-modified/php-fpm:8.4 .
.PHONY: build

compose: 
	docker compose up -d
.PHONE: compose