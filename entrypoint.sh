#!/bin/bash

# Copy .env jika belum ada (baru di-clone)
if [ ! -f .env ]; then
    cp .env.example .env
fi

composer install --no-interaction

npm install

# Generate key jika kosong
if ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate
fi

sleep 10

php artisan migrate:fresh --seed --force

php artisan storage:link

npm run dev &

exec php artisan serve --host=0.0.0.0 --port=8000
