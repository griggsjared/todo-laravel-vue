#!/bin/sh
php artisan config:cache
php artisan view:cache
php artisan route:cache
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
