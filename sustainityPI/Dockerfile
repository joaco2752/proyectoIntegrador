FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar archivos de composer para cachear dependencias
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-interaction

# Copiar el resto del código
COPY . .

# Dar permisos adecuados a storage y bootstrap/cache (ajustar según sea necesario)
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]