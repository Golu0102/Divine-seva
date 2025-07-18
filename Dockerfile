# Dockerfile
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libjpeg-dev libonig-dev \
    build-essential nodejs npm libpq-dev

# ✅ Add PostgreSQL support
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# ✅ Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# ✅ Install JS deps and build
RUN npm install && npm run build

# ✅ Cache Laravel config/routes/views
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# ✅ Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# ✅ Expose correct port (must match render.yaml)
EXPOSE 10000

# ✅ Final run command (matches render.yaml startCommand)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
