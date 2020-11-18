#!/bin/bash

echo "upstream php-upstream { server exchange_php:9000; }" > /etc/nginx/conf.d/upstream.conf

sed -i -e "s/NGINX_FRONT/$NGINX_FRONT/g" /etc/nginx/sites-available/app.conf

rm -rf /var/log/nginx/*

nginx -g "daemon off;"