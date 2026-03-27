FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    git \
    curl \
    sqlite3

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip intl

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Update Apache DocumentRoot to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port
EXPOSE 80

# Environment variables for production
ENV APP_ENV production
ENV APP_DEBUG false

# Use custom entrypoint to run migrations
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]
