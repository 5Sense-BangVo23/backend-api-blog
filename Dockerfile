# Use the latest PHP 8.1 image with Composer
FROM php:8.2

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install system dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends unzip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up working directory
WORKDIR /var/www/html

# Copy the Laravel source code into the container
COPY ./src /var/www/html


# Install Laravel dependencies using Composer
RUN composer --version
RUN composer install --no-interaction --prefer-dist --no-progress --no-suggest

# Set permissions for storage and bootstrap folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap

# Copy .env.example and generate keys for Laravel
COPY src/.env.example /var/www/html/.env
RUN php artisan key:generate

# Open port 80 for web access
EXPOSE 80

# Command to run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
