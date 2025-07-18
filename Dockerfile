FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libjpeg-dev libonig-dev \
    build-essential nodejs npm libpq-dev

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Copy and prepare env
RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel key
RUN php artisan key:generate

# Run migrations (force for production)
RUN php artisan migrate --force

# Build frontend
RUN npm install && npm run build

# Optional: cache configs
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
