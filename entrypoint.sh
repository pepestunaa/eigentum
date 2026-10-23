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

# Jalankan migrasi yang belum diterapkan — TIDAK pernah menghapus data
n=0
until php artisan migrate --force; do
    n=$((n+1))
    if [ "$n" -ge 10 ]; then
        echo "Migrasi gagal setelah 10 percobaan, container dihentikan"
        exit 1
    fi
    echo "Database belum siap, mencoba lagi dalam 3 detik..."
    sleep 3
done

# Seed hanya saat database masih kosong (boot pertama)
USER_COUNT=$(php artisan tinker --execute='echo \Illuminate\Support\Facades\DB::table("users")->count();' 2>/dev/null | tail -n 1)
if [ "$USER_COUNT" = "0" ]; then
    php artisan db:seed --force
fi

php artisan storage:link

npm run dev &

exec php artisan serve --host=0.0.0.0 --port=8000
