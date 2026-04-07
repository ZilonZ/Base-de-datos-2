# Base-de-datos-2
Ejercicio de CRUD para bases de datos

Descripción
-
Proyecto de ejemplo que implementa un CRUD (Create, Read, Update, Delete) con frontend estático y backend en PHP.

Archivos importantes
-
- `todolist.sql` — archivo SQL para crear la base de datos y las tablas.
- `crud_todolist/` — carpeta con los endpoints PHP del backend (`api_create.php`, `api_read.php`, `api_update.php`, `api_delete.php`).
- `db.php` — fichero de configuración de la conexión a la base de datos.
- `index.html`, `script.js`, `style.css` — frontend estático.
- `test_connection.php` — script para probar la conexión al servidor de base de datos.

Requisitos previos
-
- XAMPP instalado (para ejecutar Apache y PHP).
- PostgreSQL instalado (la base de datos de este proyecto usa PostgreSQL).
- La extensión `php_pgsql` habilitada en la instalación de PHP (activar en `php.ini` si es necesario).

Cómo ejecutar en otra máquina (copiar el "portafolio")
-
1. Copiar los archivos del proyecto
	- Copia la carpeta completa del proyecto al directorio `htdocs` de XAMPP. Por ejemplo en Windows:

```
C:\xampp\htdocs\Base-de-datos-2
```

2. Instalar y arrancar servicios
	- Instala XAMPP y PostgreSQL en la máquina destino.
	- Abre el XAMPP Control Panel y arranca Apache.
	- Asegúrate de que el servicio de PostgreSQL esté en ejecución (puede ser el servicio de Windows o iniciado desde pgAdmin).

3. Crear la base de datos e importar `todolist.sql`
	- Desde una consola con `psql` (ajusta el usuario y la ruta al archivo):

```
REM Crear la BD (si no existe)
psql -U postgres -c "CREATE DATABASE todolist;"

REM Importar el archivo SQL
psql -U postgres -d todolist -f "C:\xampp\htdocs\Base-de-datos-2\todolist.sql"
```

	- Como alternativa puedes usar pgAdmin: crea una base de datos nueva (`todolist`) y utiliza la opción de importar/ejecutar script SQL para cargar `todolist.sql`.

4. Configurar la conexión en `db.php`
	- Abre `db.php` y actualiza los parámetros de conexión (host, puerto —por defecto `5432` en PostgreSQL—, usuario, contraseña y nombre de la BD). Ejemplo de parámetros a revisar:

- host: `localhost`
- port: `5432`
- dbname: `todolist`
- user: `postgres` (o el usuario que uses)
- password: `tu_contraseña`

5. Habilitar extensión PHP (si es necesario)
	- Si al probar la conexión recibes errores sobre funciones de PostgreSQL, edita `php.ini` (el que usa XAMPP) y habilita la extensión `extension=pgsql` o `php_pgsql.dll`, luego reinicia Apache.

6. Probar la aplicación
	- Abre un navegador y visita:

```
http://localhost/Base-de-datos-2/index.html
```

	- Si Apache corre en otro puerto (por ejemplo `8080`), usa `http://localhost:8080/Base-de-datos-2/index.html`.

Notas y solución de problemas
-
- Si las APIs PHP devuelven errores, revisa `error_log` de Apache o activa la visualización de errores en `php.ini` durante desarrollo.
- Comprueba `test_connection.php` para verificar que `db.php` tiene las credenciales correctas.
- Si PostgreSQL está en otra máquina o puerto distinto, actualiza `host` y `port` en `db.php` en consecuencia.
- Firewall: permite el puerto usado por Apache (80/8080) y por PostgreSQL (5432) si necesitas acceso remoto.

APIs disponibles (backend)
-
- `crud_todolist/api_create.php` — crear tarea
- `crud_todolist/api_read.php` — leer tareas
- `crud_todolist/api_update.php` — actualizar tarea
- `crud_todolist/api_delete.php` — eliminar tarea

Soporte
-
Si quieres, puedo:
- Importar `todolist.sql` localmente aquí si me das detalles de conexión.
- Ajustar `db.php` para tu entorno específico.

---
Actualizado para facilitar la copia y ejecución en otra máquina (XAMPP + PostgreSQL).
