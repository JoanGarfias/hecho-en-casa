# MONTAR EL PROYECTO EN UN HOSTING
# Requisitos previos
1. Tener un proyecto de Laravel existente.
2. Tener una cuenta en Hostinger.
3. Tener acceso a la consola de comandos (SSH) de Hostinger.

# Paso 1: Preparar el proyecto de Laravel
1. Asegúrate de que el proyecto esté actualizado y funcione correctamente en tu entorno local.
2. Realiza un commit de los cambios en tu repositorio de control de versiones (si lo tienes).
3. Exporta la base de datos del proyecto en un archivo SQL.

# Paso 2: Crear un nuevo proyecto en Hostinger
1. Inicia sesión en tu cuenta de Hostinger.
2. Ve a la sección "Hosting" y selecciona "Crear un nuevo proyecto".
3. Selecciona "PHP" como tipo de proyecto y elige la versión de PHP que requiere tu proyecto de Laravel.
4. Selecciona la base de datos que deseas utilizar (MySQL o PostgreSQL).

# Paso 3: Subir el proyecto de Laravel a Hostinger
1. Utiliza un cliente FTP (como FileZilla) para subir los archivos del proyecto de Laravel al servidor de Hostinger.
2. Asegúrate de subir todos los archivos y directorios, incluyendo el archivo ".env".

# Paso 4: Configurar la base de datos en Hostinger
1. Crea una nueva base de datos en Hostinger y asigna un usuario y contraseña.
2. Importa el archivo SQL de la base de datos que exportaste en el Paso 1.
3. Actualiza el archivo ".env" del proyecto de Laravel con los datos de la nueva base de datos.

# Paso 5: Configurar el proyecto de Laravel en Hostinger
1. Actualiza el archivo "config/database.php" del proyecto de Laravel con los datos de la nueva base de datos.
2. Ejecuta el comando "composer install" en la consola de comandos de Hostinger para instalar las dependencias del proyecto.
3. Ejecuta el comando "php artisan migrate" para ejecutar las migraciones de la base de datos.

# Paso 6: Configurar el dominio y el servidor web
1. Configura el dominio para que apunte al servidor de Hostinger.
2. Configura el servidor web (Apache o Nginx) para que sirva el proyecto de Laravel.



# MONTAR LA BASE DE DATOS

# Requisitos previos
1. Tener acceso a la base de datos en Railway.
2. Tener una cuenta en Hostinger y haber creado una nueva base de datos.
3. Tener los datos de conexión de ambas bases de datos (host, puerto, usuario, contraseña y nombre de la base de datos).

# Paso 1: Exportar la base de datos de Railway
1. Inicia sesión en tu cuenta de Railway.
2. Ve a la sección "Bases de datos" y selecciona la base de datos que deseas migrar.
3. Haz clic en el botón "Exportar" y selecciona el formato de exportación (por ejemplo, SQL).
4. Selecciona las opciones de exportación que desees (por ejemplo, incluir datos, incluir estructura, etc.).
5. Haz clic en el botón "Exportar" para descargar el archivo de exportación.

# Paso 2: Crear una nueva base de datos en Hostinger
1. Inicia sesión en tu cuenta de Hostinger.
2. Ve a la sección "Hosting" y selecciona "Bases de datos".
3. Haz clic en el botón "Crear una nueva base de datos".
4. Selecciona el tipo de base de datos que deseas crear (por ejemplo, MySQL).
5. Ingresa los datos de conexión para la nueva base de datos (host, puerto, usuario, contraseña y nombre de la base de datos).

# Paso 3: Importar la base de datos en Hostinger
1. Inicia sesión en tu cuenta de Hostinger.
2. Ve a la sección "Hosting" y selecciona "Bases de datos".
3. Selecciona la base de datos que creaste en el Paso 2.
4. Haz clic en el botón "Importar" y selecciona el archivo de exportación que descargaste en el Paso 1.
5. Selecciona las opciones de importación que desees (por ejemplo, reemplazar tablas existentes, etc.).
6. Haz clic en el botón "Importar" para importar la base de datos.

# Paso 4: Actualizar la configuración de la aplicación
1. Actualiza la configuración de tu aplicación para que utilice la nueva base de datos en Hostinger.
2. Asegúrate de actualizar los datos de conexión (host, puerto, usuario, contraseña y nombre de la base de datos).
