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

install: install-app install-frontend

start-app:
	php artisan serve --host 0.0.0.0 --port 8000
