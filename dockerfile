FROM php:8.2-cli

# Instalar dependencias del sistema y Node.js (v18 LTS como ejemplo)
RUN apt-get update && apt-get install -y \
    curl zip unzip git libpq-dev libzip-dev libonig-dev libxml2-dev gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip dom

# Verificar versiones
RUN node -v && npm -v

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuración personalizada de PHP
COPY .docker/php.ini /usr/local/etc/php/php.ini

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar primero package.json y lock para aprovechar el cache
COPY package*.json ./

# Instalar dependencias de frontend
RUN npm install

# Copiar el resto del proyecto
COPY . .

# Ejecutar build del frontend
RUN npm run build

# Instalar dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generar APP_KEY, symlink, cachear config y vistas
RUN php artisan key:generate && \
    php artisan storage:link && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Asignar permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto
EXPOSE 8000

# Levantar Laravel con el servidor embebido
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
