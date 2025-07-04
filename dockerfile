# Use official PHP image with Apache
FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory inside container
WORKDIR /var/www/html

# Copy project files to container
COPY . /var/www/html

# Set proper DocumentRoot to /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ensure correct permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install composer dependencies (verbose output)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist -vvv

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
