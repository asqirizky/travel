FROM php:8.4-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    curl \
    gnupg \
    ca-certificates \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring zip gd bcmath exif opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 22 (dipakai untuk Vite / build asset)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Konfigurasi upload & entrypoint
COPY docker/php/upload-limit.ini /usr/local/etc/php/conf.d/upload-limit.ini
COPY docker/php/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
