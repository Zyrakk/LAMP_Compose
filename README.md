# LAMP_Compose

Este proyecto contiene la configuración necesaria para levantar un entorno LAMP (Linux, Apache, MySQL/MariaDB, PHP) utilizando Docker Compose, e incluye phpMyAdmin para la administración de la base de datos. Además, se personalizan las páginas de error y se configuran directivas específicas para el servidor Apache.

---

## Estructura de Directorios

```bash
proyecto-lamp/
├── docker-compose.yml
├── db_data/
├── apache-php/
│   ├── Dockerfile
│   ├── apache2.conf
│   ├── 000-default.conf
│   ├── custom_404.html
│   ├── custom_403.html
│   └── www/
│       ├── datos1.php
│       ├── test_mysqli.php
│       └── index.php (opcional)
```

## Descripción de cada archivo

1. **docker-compose.yml**  
   - Define los servicios:
     - **web**: Contenedor con Apache + PHP 8.3.  
     - **db**: Contenedor de la base de datos (MariaDB o MySQL).  
     - **phpmyadmin**: Contenedor para administrar la base de datos vía web.  
   - Configura puertos, volúmenes y variables de entorno.

2. **db_data/**  
   - Carpeta o volumen local para almacenar datos persistentes de la base de datos.

3. **apache-php/**  
   - Carpeta con los archivos necesarios para construir la imagen personalizada de Apache + PHP 8.3.

   - **Dockerfile**  
     - Basado en la imagen oficial de PHP (tag `8.3-apache`).  
     - Instala extensiones como `mysqli`.  
     - Copia y habilita configuraciones de Apache (apache2.conf, 000-default.conf) y páginas de error personalizadas.

   - **apache2.conf**  
     - Configuración global de Apache.  
     - Incluye la directiva para personalizar el ErrorDocument 404.

   - **000-default.conf**  
     - Configura el VirtualHost por defecto.  
     - Cambia el `DirectoryIndex` a `datos1.php`.  
     - Deshabilita la indexación de directorios (`Options -Indexes`).  
     - Personaliza la página de error 403.

   - **custom_404.html** y **custom_403.html**  
     - Páginas estáticas para mostrar errores 404 y 403 de manera personalizada.

   - **www/**  
     - Directorio mapeado a `/var/www/html` dentro del contenedor.  
       - **datos1.php**: Archivo principal establecido por `DirectoryIndex`.  
       - **test_mysqli.php**: Prueba de conexión a la base de datos usando `mysqli`.  
       - **index.php** (opcional): Archivo adicional de ejemplo o pruebas.
