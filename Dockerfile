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
    libfreetype6-dev \
    nodejs \
    npm

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath gd

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Copiar código
COPY . /var/www/html

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts || true

# Instalar dependencias de Node y compilar assets
RUN cd /var/www/html && npm install && npm run build

# ✅ Crear carpeta para imágenes y dar permisos
RUN mkdir -p /var/www/html/public/img/clientes
RUN chmod -R 777 /var/www/html/public/img/clientes

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80