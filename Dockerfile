FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath gd

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache para usar la carpeta public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar archivos de Composer primero
COPY composer.json composer.lock ./

# Instalar dependencias (skip-scripts para evitar artisan)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar el resto del código
COPY . .

# Ejecutar scripts después de tener todo el código
RUN composer run-script post-autoload-dump

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Crear archivo .env temporal si no existe
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generar key
RUN php artisan key:generate --no-interaction

EXPOSE 80