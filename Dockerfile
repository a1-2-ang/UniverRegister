FROM php:8.2-apache

# Copiar el código al directorio del servidor web
COPY . /var/www/html/

# Activar el módulo de reescritura si usas URLs amigables
RUN a2enmod rewrite
