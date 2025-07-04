# Use official PHP image with Apache
FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite

# Install PHP extensions (adjust as needed)
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory inside container
WORKDIR /var/www/html

# Copy project files to container
COPY . /var/www/html

# Set proper DocumentRoot to /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ensure correct permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]

# Change DocumentRoot to point to the public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
