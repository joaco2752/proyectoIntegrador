# Dockerfile
FROM php:8.2-fpm

# Establece el directorio de trabajo
WORKDIR /var/www

# Instala dependencias del sistema y extensiones de PHP necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de composer para cachear dependencias
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-interaction

# Copia el resto del código fuente
COPY . .

# Ajusta permisos en storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www

# Expone el puerto en el que corre php-fpm
EXPOSE 9000

# Comando para arrancar php-fpm
CMD ["php-fpm"]
