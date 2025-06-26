# 1. Se establece la imagen base para el contenedor, que es una imagen oficial de PHP
#    con soporte para PHP-FPM (FastCGI Process Manager) en la versión 7.2.7 sobre Alpine Linux 3.7.
#    Alpine es una distribución ligera y eficiente, ideal para contenedores.
FROM php:7.2.7-fpm-alpine3.7

# 2. Actualiza el índice de los paquetes disponibles e instala las actualizaciones más recientes
#    en la imagen base. El uso de "apk" (Alpine Package Keeper) es común en Alpine Linux para la gestión
#    de paquetes.
RUN apk update; \  
    apk upgrade;     

# 3. Instala la extensión "mysqli" de PHP, que es necesaria para la interacción con bases de datos MySQL.
#    "docker-php-ext-install" es un script que facilita la instalación de extensiones comunes de PHP en imágenes oficiales de Docker.
RUN docker-php-ext-install mysqli
# 4. Instala la extensión "pdo" y "pdo_mysql" para habilitar soporte para bases de datos utilizando PDO.
#    Primero, se instalará el soporte para PDO y luego se instalará el controlador para MySQL.
RUN docker-php-ext-install pdo pdo_mysql