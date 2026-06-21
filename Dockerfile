# 1. Usar la imagen oficial de PHP con Apache incorporado
FROM php:8.2-apache

# 2. Instalar la extensión PDO MySQL para que funcione nuestra base de datos
RUN docker-php-ext-install pdo pdo_mysql

# 3. Habilitar el módulo de reescritura de Apache (mod_rewrite)
RUN a2enmod rewrite

# 4. Copiar todo el código de nuestro proyecto dentro del contenedor
COPY . /var/www/html/

# 5. Dar permisos correctos a las carpetas para que Apache pueda leerlas
RUN chown -R www-data:www-data /var/www/html/

# 6. Exponer el puerto 80 estándar para tráfico web
EXPOSE 80
