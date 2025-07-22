FROM node:18 AS node-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build


FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libjpeg-dev libonig-dev \
    build-essential nodejs npm libpq-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application source code
COPY . .

# Copy built assets from node build stage
COPY --from=node-builder /app/public/build public/build
COPY --from=node-builder /app/resources resources
COPY --from=node-builder /app/node_modules node_modules

# Copy and prepare .env
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel app key
RUN php artisan key:generate

# Run migrations
RUN php artisan migrate --force

# Cache config, routes, views
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Set proper permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose Laravel port
EXPOSE 8000

# Start Laravel using built-in PHP server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
