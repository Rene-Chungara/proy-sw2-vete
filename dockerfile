FROM php:8.2-cli

# Instalar extensiones necesarias para Laravel y PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip dom

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuración personalizada de PHP
COPY .docker/php.ini /usr/local/etc/php/php.ini

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar todo el proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generar APP_KEY, crear symlink, cachear config y vistas
RUN php artisan key:generate && \
    php artisan storage:link && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Asegurar permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Levantar Laravel con el servidor embebido
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
