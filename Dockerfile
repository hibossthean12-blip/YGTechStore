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
    git \
    curl \
    zip \
    unzip \
    sqlite

# Install PHP extensions using the official helper
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath gd opcache

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Copy built assets from builder stage
COPY --from=assets-builder /app/public/build ./public/build

# Install PHP dependencies
RUN APP_ENV=production DB_CONNECTION=sqlite DB_DATABASE=:memory: \
    composer install --no-dev --optimize-autoloader

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
