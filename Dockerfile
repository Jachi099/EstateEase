# Step 1: Use the official PHP image
FROM php:8.1-fpm

# Step 2: Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Step 3: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 4: Set the working directory
WORKDIR /var/www

# Step 5: Copy the composer files
COPY composer.json composer.lock /var/www/

# Step 6: Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Step 7: Copy the rest of the application files
COPY . /var/www

# Step 8: Set the correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Step 9: Expose the port that the app will run on
EXPOSE 8080

# Step 10: Define the start command to run Laravel with PHP built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
