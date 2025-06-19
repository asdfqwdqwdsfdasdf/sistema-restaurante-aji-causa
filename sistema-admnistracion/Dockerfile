FROM php:8.2-apache

# Instalar extensiones necesarias para MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copia tu código PHP al directorio web del contenedor
COPY . /var/www/html/

# (Opcional) Habilita mod_rewrite si lo necesitas
RUN a2enmod rewrite
