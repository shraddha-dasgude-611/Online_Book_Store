# Use official PHP image
FROM php:8.2-apache

# Enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy project files into the Apache web directory
COPY project/ /var/www/html/

# Set correct permissions
RUN chmod -R 755 /var/www/html

# Set index file
RUN echo "DirectoryIndex home.php" >> /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80
