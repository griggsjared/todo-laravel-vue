FROM php:8.3-cli-alpine

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/web/php-opocache-cfg.ini /usr/local/etc/php/conf.d/php-opocache-cfg.ini

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

USER www-data

RUN composer install --no-dev --no-interaction --no-progress --no-suggest --optimize-autoloader

RUN php artisan config:cache

CMD []
