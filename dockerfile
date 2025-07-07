# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies: zip, unzip, curl, npm, git, PHP extensions
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

# Fix Apache DocumentRoot to Laravel public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Enable rewrite module (already done above, but safe here too)
RUN a2enmod rewrite

# Allow .htaccess overrides and grant access in public directory
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

# Create non-root user and give ownership
RUN useradd -m appuser && chown -R appuser /var/www/html
USER appuser

# Install PHP dependencies without scripts
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Switch back to root for npm install/build and permissions fix
USER root

RUN npm install
RUN npm run build

# Fix permissions so Apache can access storage/cache and public folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
