# LAMP_Compose

Este proyecto configura un entorno LAMP (Linux, Apache, MySQL/MariaDB y PHP) con Docker Compose. Además, incluye phpMyAdmin para la administración de bases de datos, configuración de autenticación en directorios, servidores virtuales y páginas de error personalizadas.

---

## Estructura de Carpetas

```bash
proyecto-lamp/
├── docker-compose.yml
├── apache-php/
│   ├── Dockerfile
│   ├── apache2.conf
│   ├── 000-default.conf
│   ├── cv-web.conf
│   ├── blog-web.conf
│   ├── owncloud-web.conf
│   ├── custom_404.html
│   ├── custom_403.html
│   ├── .htpasswd
│   └── www/
│       ├── datos1.php
│       ├── test_mysqli.php
│       ├── index.php            # (opcional)
│       ├── archivos/
│       │   ├── .htaccess
│       │   └── index-asir.php
│       ├── cv/
│       │   └── index.html
│       ├── blog/
│       │   └── index.html
│       └── owncloud/
│           └── owncloud.html
```

---

## Descripción de Archivos

### 1. `docker-compose.yml`
   - Define los servicios:
     - **web**: Apache + PHP 8.3
     - **db**: Base de datos (MariaDB o MySQL)
     - **phpmyadmin**: Interfaz web para gestionar la base de datos
   - Especifica puertos, volúmenes y variables de entorno para cada contenedor.

### 2. `apache-php/`
   - Contiene los archivos de configuración y construcción de la imagen personalizada de Apache + PHP 8.3.

   - **Dockerfile**
     - Basado en la imagen oficial `php:8.3-apache`.
     - Instala la extensión `mysqli`.
     - Copia las configuraciones de Apache y los archivos de error personalizados.

   - **apache2.conf**
     - Configuración global de Apache.
     - Incluye la directiva para la página de error 404.

   - **000-default.conf**
     - Configuración del VirtualHost por defecto.
     - Establece `datos1.php` como página principal.
     - Desactiva el listado de directorios (`Options -Indexes`).
     - Personaliza la página de error 403.

   - **cv-web.conf**, **blog-web.conf**, **owncloud-web.conf**
     - Configuración de servidores virtuales para `cv.localhost.com`, `blog.localhost.com` y `www.localhost.com:8123`.

   - **custom_404.html** y **custom_403.html**
     - Páginas de error personalizadas para 404 y 403.

   - **.htpasswd**
     - Archivo de autenticación para proteger el directorio `/archivos`.

   - **www/**
     - Se mapea a `/var/www/html` dentro del contenedor.
       - **datos1.php**: Página principal (`DirectoryIndex`).
       - **test_mysqli.php**: Prueba de conexión con la base de datos.
       - **index.php** (opcional): Archivo adicional de prueba.
       - **archivos/**: Contiene `.htaccess` para autenticación y `index-asir.php`.
       - **cv/**, **blog/** y **owncloud/**: Contienen páginas por defecto para sus respectivos subdominios y puertos configurados.

---

## Instalación y Uso

1. **Clonar el proyecto**
   ```bash
   git clone <repositorio>
   cd LAMP_Compose
   ```

2. **Construir y ejecutar los contenedores**
   ```bash
   docker-compose build
   docker-compose up -d
   ```

3. **Verificar contenedores en ejecución**
   ```bash
   docker ps
   ```

4. **Acceder a los servicios**
   - **Sitio principal**: `http://localhost`
   - **phpMyAdmin**: `http://localhost:8081`
   - **Prueba de conexión a MySQL**: `http://localhost/test_mysqli.php`
   - **Subdominios VirtualHost** (añadir a `/etc/hosts` si es necesario):
     - `http://cv.localhost.com`
     - `http://blog.localhost.com`
   - **Servidor Virtual por Puerto**:
     - `http://www.localhost.com:8123`
   - **Acceso protegido a `/archivos`**: `http://localhost/archivos` (Usuario: `ASIR`, Contraseña: `123456`).

5. **Detener contenedores**
   ```bash
   docker-compose down
   ```

---

## Notas
- Asegúrate de que los subdominios (`cv.localhost.com`, `blog.localhost.com`, etc.) estén configurados en DNS o en el archivo `/etc/hosts`.
```/etc/hosts
127.0.0.1    cv.localhost.com
127.0.0.1    blog.localhost.com
127.0.0.1    www.localhost.com
```

- Puedes personalizar los archivos de configuración de Apache en `apache-php/`.
- Si deseas persistencia de datos para MySQL/MariaDB, asegúrate de usar un volumen (`db_data`).

## Rehacer los contenedores
```bash
docker compose down --volumes --remove-orphans
docker compose build --no-cache
docker compose up -d
```
