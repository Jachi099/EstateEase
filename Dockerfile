# Use an official PHP runtime as a parent image
FROM php:8.1-fpm

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && apt-get clean

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy the current directory contents into the container
COPY . .

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose the port the app will run on
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
