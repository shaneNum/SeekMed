#!/bin/sh
set -e

echo "Waiting for MySQL.."
until nc -z seekmed_db 3306; do
  echo "MySQL is unavailable.."
  sleep 2
done

echo "Running migrations.."
php artisan migrate:fresh --seed

echo "Starting PHP-FPM.."
exec php-fpm
