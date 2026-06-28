FROM php:8.3-cli-alpine AS vendor
RUN apk add --no-cache git unzip
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json* vite.config.js* ./
RUN npm install
COPY . .
RUN npm run build
FROM php:8.3-fpm-alpine
# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    mariadb-client \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev
# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmath opcache
# Setup Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf
# Setup Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# Setup PHP config
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini
WORKDIR /var/www/html
# Copy application files
COPY . .
COPY --from=vendor /app/vendor/ ./vendor/
COPY --from=frontend /app/public/build/ ./public/build/
# Set permissions
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
# Run supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]