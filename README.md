# Eigentum

Property marketplace built with Laravel 10, Inertia + React 19, and Vite. Serves listings, agents, developers, orders, and Midtrans payments on top of MySQL.

## Stack

- PHP 8.2 / Laravel 10
- React 19 + Inertia + StyleX (Vite 8)
- MySQL 8

## Run with Docker (recommended)

Requires Docker only. The container installs Composer and npm dependencies, generates the app key, runs migrations, seeds an empty database, and builds the frontend on first start.

```bash
cp .env.example .env      # then set DB_PASSWORD (and DB_USERNAME if you want a non-root user)
docker compose up -d --build
```

Open http://localhost:8000. MySQL is exposed on `localhost:3307` if you need a client.

```bash
docker compose logs -f app   # follow app logs
docker compose down          # stop
docker compose down -v       # stop and wipe the database volume
```

The project directory is bind-mounted, so edits apply without rebuilding. Rebuild only when `Dockerfile` or `entrypoint.sh` changes.

## Run locally (without Docker)

Requirements: PHP 8.2 with `pdo_mysql`, Composer, Node 20.19+ (or 22.12+), MySQL 8.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Set the database in `.env` — locally the host is `127.0.0.1`, not `mysql`:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eigentum
DB_USERNAME=root
DB_PASSWORD=your-password
```

Then create the database, load the schema and demo data, and start both servers:

```bash
php artisan migrate --seed
php artisan storage:link
npm install
npm run dev            # Vite dev server, terminal 1
php artisan serve      # http://127.0.0.1:8000, terminal 2
```

For a production-style frontend build instead of the dev server, run `npm run build`.

## Seeded accounts

All seeded users share the password `password`.

| Role      | Email                  |
| --------- | ---------------------- |
| Admin     | `admin@example.com`    |
| Agent     | `agent@example.com`    |
| Developer | `developer@example.com`|
| User      | `user@example.com`     |

## Useful commands

```bash
php artisan test           # run the test suite
php artisan migrate:fresh --seed   # reset the database
./vendor/bin/pint          # format PHP code
```
