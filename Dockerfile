FROM php:7.3-fpm
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl
RUN docker-php-ext-install pdo mbstring
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo  mbstring

WORKDIR /app
COPY . /app
RUN composer install

CMD touch database/database.sqlite
CMD chmod 777 database/database.sqlite
CMD cp .env.example .env
CMD php artisan key:generate
CMD php artisan migrate
CMD php artisan db:seed

CMD php artisan serve --host=0.0.0.0 --port=8000
# EXPOSE 8000

