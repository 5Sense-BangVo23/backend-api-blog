# Use the latest PHP 8.0 image with Composer
FROM php:8.0

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

#  Composer Install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up working directory
WORKDIR /var/www/html

# Copy the Laravel source code into the container on the Docker Desktop App
COPY . /var/www/html

# Install Laravel dependencies using Composer
RUN composer install --no-interaction

# Set permissions for storage and bootstrap folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap

# Create environment file
COPY .env.example .env

# Generate keys for Laravel
RUN php artisan key:generate

# Open port 80 for web access
EXPOSE 80

# Command to run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]

