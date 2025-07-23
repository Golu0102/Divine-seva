FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libjpeg-dev libonig-dev \
    build-essential nodejs npm libpq-dev

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Copy and prepare .env if needed (optional, for local builds only)
# RUN cp .env.example .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install & build frontend assets
RUN npm install && npm run build

# Cache Laravel configs
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose port
EXPOSE 8000

# Start Laravel app
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
