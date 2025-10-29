# Use the official PHP image
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all project files to the Apache web directory
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Tell Apache to treat home.php as the index page
RUN echo "DirectoryIndex home.php" >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80
