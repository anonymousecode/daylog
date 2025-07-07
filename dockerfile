# Use official PHP with Apache
FROM php:8.2-apache

# Install system dependencies (php extensions, node, npm)
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip npm \
    && docker-php-ext-install zip pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Create non-root user
RUN useradd -m appuser && chown -R appuser /var/www/html
USER appuser

# Install composer dependencies WITHOUT scripts (avoid artisan errors)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Switch back to root for npm install/build and permissions
USER root

RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Now run artisan package discover as www-data user (to fix discovery)
USER www-data
RUN php artisan package:discover

# Expose and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
