FROM php:8.3-apache

# Instala la extensión mysqli
RUN docker-php-ext-install mysqli

# Crear la carpeta de logs de Apache y darle permisos
RUN mkdir -p /etc/apache2/logs && chmod -R 755 /etc/apache2/logs

# Crea directorios necesarios para VirtualHosts
RUN mkdir -p /var/www/blog /var/www/cv /var/www/owncloud /var/log/apache2

# Evita la advertencia "Could not reliably determine the server's FQDN"
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia configuraciones de Apache
COPY apache2.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY cv-web.conf /etc/apache2/sites-available/cv-web.conf
COPY blog-web.conf /etc/apache2/sites-available/blog-web.conf
COPY owncloud-web.conf /etc/apache2/sites-available/owncloud-web.conf

# Copia páginas de error personalizadas
COPY custom_404.html /var/www/html/
COPY custom_403.html /var/www/html/

# Copia el fichero .htpasswd
COPY .htpasswd /var/www/html/archivos/.htpasswd

# Habilita sitios y módulos necesarios
RUN a2enmod rewrite && \
    a2ensite 000-default.conf && \
    a2ensite cv-web.conf && \
    a2ensite blog-web.conf && \
    a2ensite owncloud-web.conf

# Copia el script de inicio y le da permisos de ejecución
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Usa el script de entrada en lugar del CMD predeterminado
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
