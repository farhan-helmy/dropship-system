#!/bin/sh
# activate maintenance mode
sudo php artisan down
# update source code
git pull origin master
# update PHP dependencies
composer install --no-interaction --no-dev --prefer-dist
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.
# update database
php artisan migrate --force
php artisan tenants:migrate
# --force  Required to run when in production.
# stop maintenance mode
sudo php artisan up
