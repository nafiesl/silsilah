# use bullseye variant because it doesn't have network issue in m1 mac & intel
FROM php:8.1-fpm-bullseye

# Install dependencies
RUN apt-get update
RUN apt-get install -y zip nginx git
RUN useradd -r nginx

# Install PHP-Mysql extensions
RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

WORKDIR /var/www

# Copy source code
COPY . .
RUN mv nginx.conf /etc/nginx/nginx.conf

# Install composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

RUN composer install
RUN composer dumpautoload --optimize

# Copy .env file
COPY .env.example .env

# Set up permissions
RUN chown -R www-data:www-data /var/www

ENTRYPOINT make init && nginx && php-fpm
