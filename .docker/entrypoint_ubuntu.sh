#!/bin/bash

cd /mnt/csv-products

if [ ! -f "composer.phar" ]; then
    wget https://getcomposer.org/download/2.8.6/composer.phar
fi

service php8.3-fpm start
service nginx start
php composer.phar install

chmod -R 777 /mnt/csv-products/storage
chmod -R 777 /mnt/csv-products/bootstrap/cache

php artisan migrate
php artisan cache:clear
php artisan view:clear
php artisan route:clear

service sendmail start -d

tail -f /dev/null


