# Stage 1: Build assets
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP environment
FROM php:8.4-fpm-alpine

# Install system dependencies (runtime only)
RUN apk add --no-cache \
    nginx \
    ca-certificates \
    git \
    curl \
    zip \
    unzip \
    sqlite \
    libpq

# Install PHP extensions using the official helper
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath gd opcache

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer*.json ./

# Install PHP dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy application code
COPY . .

# Copy built assets from builder stage
COPY --from=assets-builder /app/public/build ./public/build

# Finish composer installation
RUN composer dump-autoload --optimize --no-dev

# Setup Nginx configuration
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Setup Entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Use entrypoint
ENTRYPOINT ["entrypoint.sh"]
