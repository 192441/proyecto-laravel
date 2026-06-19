FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev unzip git curl && \
    docker-php-ext-install pdo pdo_pgsql pgsql zip

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts || true

# Crear carpeta para imágenes y dar permisos
RUN mkdir -p /var/www/html/public/img/clientes
RUN chmod -R 775 /var/www/html/public/img/clientes
RUN chown -R www-data:www-data /var/www/html/public/img/clientes

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80