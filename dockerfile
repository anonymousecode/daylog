FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl npm git libzip-dev libssl-dev pkg-config libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

# Fix Apache DocumentRoot to Laravel public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

# Set permissions for Laravel folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Switch to appuser (create if needed)
RUN useradd -m appuser && chown -R appuser /var/www/html
USER appuser

# Install PHP dependencies *with scripts* as appuser
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Switch back to root for npm install/build
USER root

RUN npm install
RUN npm run build

# Fix permissions so Apache can access storage/cache and public folders again
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

EXPOSE 80

CMD ["apache2-foreground"]
