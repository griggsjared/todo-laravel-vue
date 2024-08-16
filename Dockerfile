FROM serversideup/php:8.3-fpm-nginx-alpine as base

COPY . /var/www/html

USER root

RUN if [ ! -f /var/www/html/database/database.sqlite ]; then touch /var/www/html/database/database.sqlite; fi

RUN chown -R www-data:www-data /var/www/html

USER www-data

RUN cd /var/www/html && composer install

RUN cd /var/www/html && php artisan key:generate

RUN cd /var/www/html && php artisan migrate --force
