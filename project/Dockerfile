# Use official PHP 8.2 with Apache
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all project files into Apache web directory
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
