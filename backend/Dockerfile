# Image PHP avec les extensions requises
FROM php:8.2-fpm

# Installation des dépendances
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie des fichiers du projet
WORKDIR /var/www
COPY . .

# Installation de Symfony et API Platform
RUN composer install

CMD ["php-fpm"]
