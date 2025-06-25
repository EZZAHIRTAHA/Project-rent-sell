# Use official PHP image with necessary extensions
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

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
    nano \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# ✅ Install Laravel dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# ✅ Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# ✅ Expose port
EXPOSE 8080

# ✅ Start Laravel dev server (for Railway or Render)
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
