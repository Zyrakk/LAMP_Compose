FROM php:8.3-apache

# Instala la extensión mysqli
RUN docker-php-ext-install mysqli

# Crea directorios necesarios para los VirtualHosts
RUN mkdir -p /var/www/blog /var/www/cv /var/www/owncloud

# Crea el directorio de logs para Apache
RUN mkdir -p /etc/apache2/logs && chmod -R 755 /etc/apache2/logs

# Evita la advertencia "Could not reliably determine the server's FQDN"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia los ficheros de configuración de Apache
COPY apache2.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY cv-web.conf /etc/apache2/sites-available/cv-web.conf
COPY blog-web.conf /etc/apache2/sites-available/blog-web.conf
COPY owncloud-web.conf /etc/apache2/sites-available/owncloud-web.conf

# Copia las páginas de error personalizadas
COPY custom_404.html /var/www/html/
COPY custom_403.html /var/www/html/

# Copia el fichero .htpasswd (rutas ajustables según tu preferencia)
COPY .htpasswd /var/www/html/archivos/.htpasswd

# Habilita los sitios virtuales y módulos necesarios
RUN a2enmod rewrite \
 && a2ensite 000-default.conf \
 && a2ensite cv-web.conf \
 && a2ensite blog-web.conf \
 && a2ensite owncloud-web.conf
