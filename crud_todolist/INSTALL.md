# 🔧 Guía de Instalación - TODO List CRUD

## ⚡ Instalación Rápida (10 minutos)

### Paso 1: Preparar PostgreSQL

**Opción A - Con pgAdmin (Más fácil):**

1. Abre **pgAdmin** (busca en tu computadora o en Inicio)
2. Haz clic en **Servers** → **PostgreSQL** → ingresa contraseña si pide
3. Haz clic derecho en **PostgreSQL** → **Create** → **Database**
4. Nombre: `todolist` → Click en **Save**
5. Abre una ventana de Query:
   - Haz clic derecho en la BD `todolist` 
   - Selecciona **Query Tool**
6. Copia y pega el contenido de `database.sql`
7. Presiona **F5** (o click en ▶ Execute)

**Opción B - Con Terminal (Si sabes usar terminal):**

```bash
# Abre CMD y ejecuta:
psql -U postgres -c "CREATE DATABASE todolist;"
psql -U postgres -d todolist -f database.sql
```

### Paso 2: Preparar Archivos del Proyecto

1. Ubica tu carpeta de XAMPP:
   - Generalmente: `C:\xampp\htdocs\`
2. Coloca la carpeta `crud_todolist` dentro de `htdocs`
3. Verifica que estos archivos estén dentro:
   - ✓ index.html
   - ✓ style.css
   - ✓ script.js
   - ✓ db.php
   - ✓ api_create.php
   - ✓ api_read.php
   - ✓ api_update.php
   - ✓ api_delete.php

### Paso 3: Iniciar Servicios XAMPP

1. Abre **XAMPP Control Panel**
2. Haz clic en **Start** junto a **Apache** (debe volverse verde)
3. Haz clic en **Start** junto a **PostgreSQL** (debe volverse verde)

### Paso 4: Acceder a la Aplicación

En tu navegador, pega esta URL:
```
http://localhost/crud_todolist/index.html
```

¡Listo! Deberías ver la aplicación funcionando.

---

## ❌ Errores Comunes y Soluciones

### Error: "Cannot POST /api_create.php"
**Solución:**
- Asegúrate que Apache está corriendo (verde en XAMPP)
- Verifica que la carpeta está en `C:\xampp\htdocs\crud_todolist\`
- Recarga la página (Ctrl + F5)

### Error: "Connection refused" (BD)
**Solución:**
- Abre XAMPP → haz click en **Start** para PostgreSQL
- Espera 5 segundos a que inicie
- Recarga la página

### Error: "FATAL: database "todolist" does not exist"
**Solución:**
- Abre pgAdmin
- Crea la BD `todolist` si no existe
- Ejecuta el script `database.sql`
- Recarga la página

### No aparecen tareas o está vacío
**Solución:**
- Abre la consola (F12) y revisa los errores
- Verifica que PostgreSQL está corriendo
- Intenta agregar una tarea nueva
- Si sigue sin funcionar, consulta los logs:
  - `C:\xampp\apache\logs\error.log`

### El modal para editar no abre
**Solución:**
- Abre la consola (F12)
- No debería haber errores en rojo
- Si hay errores, anota qué dice

---

## 🔍 Verificar que Todo Funciona

### Checklist:

1. **Apache funciona:**
   - Abre `http://localhost/` en tu navegador
   - Deberías ver la página de XAMPP

2. **PostgreSQL funciona:**
   - Abre pgAdmin
   - Deberías poder conectarte

3. **BD está creada:**
   - En pgAdmin, vas a **Databases**
   - Deberías ver `todolist`

4. **Archivos están en el lugar correcto:**
   - `C:\xampp\htdocs\crud_todolist\`
   - Contiene todos los archivos

5. **La app carga:**
   - Abre `http://localhost/crud_todolist/index.html`
   - Ves la interfaz azulada

6. **Funciona el CRUD:**
   - Escribe una tarea y haz click en "+Agregar"
   - Deberías ver una notificación verde
   - La tarea aparece en la lista

---

## 🔑 Datos de Conexión por Defecto

Si necesitas cambiar algo, edita `db.php`:

```php
define('DB_HOST', 'localhost');    // No cambiar
define('DB_PORT', '5432');         // No cambiar (Puerto PostgreSQL)
define('DB_NAME', 'todolist');     // Cambiar si usas otro nombre
define('DB_USER', 'postgres');     // Usuario de PostgreSQL
define('DB_PASSWORD', 'postgres'); // Tu contraseña de PostgreSQL
```

---

## 📱 Usar en Otro Equipo

1. Copia la carpeta `crud_todolist` a la otra computadora
2. Colócala en `C:\xampp\htdocs\`
3. Sigue desde el Paso 1 (Preparar PostgreSQL)

---

## ✅ ¿Todo funciona?

Si llegaste aquí con todo en verde (✓):
- ✓ Apache corriendo
- ✓ PostgreSQL corriendo  
- ✓ BD creada
- ✓ Archivos en lugar correcto
- ✓ App carga en `http://localhost/crud_todolist/`
- ✓ Puedes crear, editar y eliminar tareas

**¡Felicidades! El CRUD está funcionando correctamente.** 🎉

---

## 📞 Si algo no funciona

1. **Abre la consola (F12)** en el navegador
2. Ve a la pestaña **Console**
3. Anota qué errores salen
4. Revisa los Errores Comunes arriba
5. Si sinconsigue, revisa los logs de PHP

**Log de Apache:**
```
C:\xampp\apache\logs\error.log
```

**Log de PostgreSQL:**
```
C:\Program Files\PostgreSQL\14\data\pg_log\
```

---

¡Ahora sí estás listo para usar el CRUD Todo List! 🚀
