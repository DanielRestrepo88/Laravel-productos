FROM php:8.2-cli

# Dependencias del sistema + extensiones PHP necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev default-mysql-client \
  && docker-php-ext-install pdo_mysql mbstring zip bcmath \
  && rm -rf /var/lib/apt/lists/*

# Composer (sin curl/TLS problemas)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
