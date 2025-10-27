FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]