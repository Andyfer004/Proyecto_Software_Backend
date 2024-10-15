# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instalar extensiones de PHP necesarias para Laravel y dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Copiar la aplicación al contenedor
COPY . /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Desactivar plugins de Composer y permitir superusuario si es necesario
ENV COMPOSER_NO_PLUGINS=1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instalar dependencias de Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Dar permisos adecuados a las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache
