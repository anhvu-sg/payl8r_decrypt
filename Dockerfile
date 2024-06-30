# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable the mod_rewrite module
RUN a2enmod rewrite

# Copy the PHP script to the Apache web server's root directory
COPY public_key.pem /var/www/html/
COPY decrypt.php /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
