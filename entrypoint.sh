#!/bin/bash

echo "🚀 Menyiapkan Environment Laravel..."

# Copy .env jika belum ada (baru di-clone)
if [ ! -f .env ]; then
    echo "📝 Membuat file .env dari .env.example..."
    cp .env.example .env
fi

echo "📦 Menginstall dependensi Composer (PHP)..."
composer install --no-interaction

echo "📦 Menginstall dependensi NPM (Frontend)..."
npm install

# Generate key jika kosong
if ! grep -q "^APP_KEY=base64:" .env; then
    echo "🔑 Men-generate APP_KEY..."
    php artisan key:generate
fi

echo "⏳ Menunggu Database siap (10 detik)..."
sleep 10

echo "🗄️ Menjalankan Migrasi & Seeder Database..."
php artisan migrate --seed --force

echo "🎨 Menjalankan server Frontend (Vite) di background..."
npm run dev &

echo "🌐 Menjalankan server Backend (Laravel)..."
exec php artisan serve --host=0.0.0.0 --port=8000
