.PHONY: *

generate-key:
	php artisan key:generate

migrate:
	php artisan migrate

storage-link:
	php artisan storage:link

init:
	make generate-key
	make migrate
	make storage-link

serve:
	php artisan serve --host 0.0.0.0 --port 8000
