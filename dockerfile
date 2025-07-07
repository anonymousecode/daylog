# Use official PHP with Apache
FROM php:8.2-apache

# Enable Apache Rewrite
RUN a2enmod rewrite

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev libonig-dev libxml2-dev unzip git curl \
    ca-certificates gnupg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Correct Apache DocumentRoot to Laravel public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Install JS dependencies and build assets
RUN npm install && npm run build

# Expose port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
