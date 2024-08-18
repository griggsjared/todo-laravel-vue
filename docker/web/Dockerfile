FROM php:8.3-fpm-alpine

RUN apk update && apk add --no-cache \
    nodejs npm \
    supervisor \
    caddy

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/web/Caddyfile /etc/caddy/Caddyfile
COPY docker/web/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/web/php-opocache-cfg.ini /usr/local/etc/php/conf.d/php-opocache-cfg.ini
COPY docker/web/php-fpm-zzz.conf /usr/local/etc/php-fpm.d/zzz.conf

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

RUN composer install --no-dev --no-interaction --no-progress --no-suggest --optimize-autoloader

RUN npm i && npm run build

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
