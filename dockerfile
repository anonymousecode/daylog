# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies: zip, unzip, curl, npm and PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip curl npm git libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Create a non-root user and give ownership
RUN useradd -m appuser && chown -R appuser /var/www/html
USER appuser

# Install PHP dependencies WITHOUT scripts (to avoid post-autoload errors)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Switch back to root for npm and permissions
USER root

# Install node modules and build assets
RUN npm install
RUN npm run build

# Fix permissions so Apache can write to storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
