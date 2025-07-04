# Use official PHP 8.1 with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions needed for Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Copy project files into container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer (using multi-stage build for latest Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies without dev dependencies and optimize autoloader
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and cache directories
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 (default for Apache)
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
