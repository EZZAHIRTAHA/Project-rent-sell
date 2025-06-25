FROM php:8.2-cli

WORKDIR /var/www

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
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Install and build assets
RUN npm install
RUN npm run build

# Create directories and set permissions
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 storage bootstrap/cache

# Generate application key if not set
RUN php artisan key:generate --no-interaction || true

# Clear and cache config
RUN php artisan config:clear && php artisan config:cache || true

EXPOSE 8080

# Create startup script
RUN echo '#!/bin/bash' > /usr/local/bin/start.sh && \
    echo 'echo "Starting Laravel application..."' >> /usr/local/bin/start.sh && \
    echo 'echo "Public Domain: $RAILWAY_PUBLIC_DOMAIN"' >> /usr/local/bin/start.sh && \
    echo 'export APP_URL="https://$RAILWAY_PUBLIC_DOMAIN"' >> /usr/local/bin/start.sh && \
    echo 'php artisan config:clear' >> /usr/local/bin/start.sh && \
    echo 'php artisan route:clear' >> /usr/local/bin/start.sh && \
    echo 'php artisan view:clear' >> /usr/local/bin/start.sh && \
    echo 'php artisan migrate --force' >> /usr/local/bin/start.sh && \
    echo 'php artisan serve --host=0.0.0.0 --port=${PORT:-8080}' >> /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh

CMD ["/usr/local/bin/start.sh"]
