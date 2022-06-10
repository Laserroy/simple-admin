key:
	php artisan key:generate

console:
	php artisan tinker

deploy:
	git push heroku main

install-app:
	composer install

install-frontend:
	npm ci

db-fresh-install:
    php artisan migrate:fresh --seed

install: install-app install-frontend

start-app:
	php artisan serve --host 127.0.0.1 --port 8000
