FROM php:8.3-apache

# Instalacion de mysqli
RUN docker-php-ext-install mysqli

# Copiar la config de apache
COPY apache2.conf /etc/apache2/apache2.conf

# Copiar el virtualhost default
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copiar las paginas de error personalizadas
COPY custom_404.html /var/www/html/
COPY custom_403.html /var/www/html/

# Habilitar modulos de apache
RUN a2enmod rewrite

# Reiniciamos Apache (en la imagen oficial ya se inicia de por si).
