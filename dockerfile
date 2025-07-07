# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Ensure permissions BEFORE install
RUN chown -R www-data:www-data /var/www/html

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Install npm and build assets
RUN npm install && npm run build

# Apache DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
