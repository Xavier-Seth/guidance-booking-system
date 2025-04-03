# Use the official PHP 8.2 image with FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    gnupg2 \
    ca-certificates

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm (LTS version, e.g. Node 18)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Optional: check versions
RUN node -v && npm -v

# Set working directory
WORKDIR /var/www

# ✅ Copy custom php.ini (increase memory limit)
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Copy project files
COPY . /var/www

# Set proper permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Expose port for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
