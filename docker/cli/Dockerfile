FROM php:8.3-cli-alpine

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/web/php-opocache-cfg.ini /usr/local/etc/php/conf.d/php-opocache-cfg.ini
COPY docker/web/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

ENTRYPOINT [ "/usr/local/bin/entrypoint.sh" ]
