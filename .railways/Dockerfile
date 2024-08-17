FROM serversideup/php:8.3-fpm-nginx-alpine

COPY .. /var/www/html

USER root

RUN apk add --update nodejs npm

RUN chown -R www-data:www-data /var/www/html

USER www-data

RUN cd /var/www/html && composer install --no-dev --no-interaction --optimize-autoloader

RUN cd /var/www/html && npm install && npm run build
