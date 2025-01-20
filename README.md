# LAMP_Compose

Este proyecto configura un entorno LAMP (Linux, Apache, MySQL/MariaDB y PHP) con Docker Compose e incluye phpMyAdmin para la administración de bases de datos. También proporciona páginas de error personalizadas y directivas de Apache ajustadas a este entorno.

---

## Estructura de Carpetas

```bash
proyecto-lamp/
├── docker-compose.yml
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

## Descripción de Archivos

1. **docker-compose.yml**
   - Define los servicios:
     - **web**: Apache + PHP 8.3
     - **db**: Base de datos (MariaDB o MySQL)
     - **phpmyadmin**: Interfaz web para gestionar la base de datos
   - Especifica puertos, volúmenes y variables de entorno para cada contenedor.

2. **db_data/**
   - Carpeta destinada a la persistencia de datos de la base de datos.

3. **apache-php/**
   - Contiene los elementos para construir la imagen de Apache + PHP 8.3.

   - **Dockerfile**
     - Basado en la imagen oficial `php:8.3-apache`.
     - Incluye extensiones como `mysqli`.
     - Copia la configuración de Apache y las páginas de error personalizadas.

   - **apache2.conf**
     - Archivo de configuración global de Apache.
     - Incluye la directiva para la página de error 404.

   - **000-default.conf**
     - Define el VirtualHost por defecto.
     - Cambia la página principal a `datos1.php`.
     - Desactiva el listado de directorios (`Options -Indexes`).
     - Personaliza el error 403.

   - **custom_404.html** y **custom_403.html**
     - Páginas de error personalizadas para 404 y 403, respectivamente.

   - **www/**
     - Se mapea a `/var/www/html` dentro del contenedor.
       - **datos1.php**: Página principal por defecto (`DirectoryIndex`).
       - **test_mysqli.php**: Verifica la conexión con la base de datos.
       - **index.php** (opcional): Archivo adicional de prueba u otro contenido.
