# 📋 Todo List CRUD - Guía Completa de Instalación

Un proyecto CRUD completo con diseño moderno glassmorphism, frontend en HTML/CSS/JavaScript y backend en PHP con PostgreSQL.

## 📁 Estructura del Proyecto

```
crud_todolist/
│── index.html          # Página principal
│── style.css           # Estilos con glassmorphism
│── script.js           # Lógica frontend con fetch API
│── db.php              # Conexión a PostgreSQL con PDO
│── api_create.php      # Endpoint para crear tareas
│── api_read.php        # Endpoint para leer tareas
│── api_update.php      # Endpoint para actualizar tareas
│── api_delete.php      # Endpoint para eliminar tareas
│── database.sql        # Script SQL para PostgreSQL
└── README.md           # Este archivo
```

## 🔧 Requisitos Previos

- **XAMPP** instalado (Apache + PHP)
- **PostgreSQL** instalado
- Navegador moderno (Chrome, Firefox, Edge, Safari)

## 📦 Instalación Paso a Paso

### 1. Configurar PostgreSQL

#### En Windows (usando pgAdmin):
1. Abre **pgAdmin** (incluido con PostgreSQL)
2. Conecta al servidor local
3. Crea un nuevo usuario:
   - Nombre: `postgres`
   - Contraseña: `postgres` (o la que prefieras)
4. Abre una consulta SQL y ejecuta el contenido de `database.sql`

#### O desde la terminal:
```bash
# Conectar a PostgreSQL
psql -U postgres

# En el prompt de psql, ejecutar:
\i database.sql
```

### 2. Instalar XAMPP y Colocar Archivos

1. **Descargar e instalar XAMPP** desde https://www.apachefriends.org/
2. Copiar la carpeta `crud_todolist` en:
   ```
   C:\xampp\htdocs\crud_todolist
   ```

### 3. Iniciar Servicios

1. Abre el **XAMPP Control Panel**
2. Inicia **Apache** (debe mostrar verde)
3. Inicia **PostgreSQL** (o tu servicio de BD)

### 4. Configurar Conexión a BD

Edita el archivo `db.php` y asegúrate que los datos coincidan con tu configuración:

```php
define('DB_HOST', 'localhost');      // Host de PostgreSQL
define('DB_PORT', '5432');           // Puerto PostgreSQL
define('DB_NAME', 'todolist');       // Nombre de la BD
define('DB_USER', 'postgres');       // Usuario PostgreSQL
define('DB_PASSWORD', 'postgres');   // Contraseña PostgreSQL
```

### 5. Acceder a la Aplicación

Abre tu navegador y ve a:
```
http://localhost/crud_todolist/index.html
```

## 🚀 Funcionalidades

### CREATE (Crear)
- Agregar nueva tarea con enter o botón "Agregar"
- Validación de campos vacíos
- Timestamp automático

### READ (Leer)
- Visualizar todas las tareas
- Ordenadas por más reciente primero
- Filtrar por estado: Todas, Pendientes, Completadas

### UPDATE (Actualizar)
- Marcar/desmarcar como completada (checkbox)
- Editar título con modal
- Cambios se guardan en BD

### DELETE (Eliminar)
- Botón para eliminar tarea
- Confirmación antes de eliminar
- Eliminación permanente

## 🎨 Características de Diseño

- ✨ Glassmorphism moderno
- 📱 Completamente responsive
- 🎯 Interfaz minimalista
- 🌙 Tema oscuro elegante
- ⚡ Animaciones suaves
- 📊 Contadores dinámicos

## 📡 API Endpoints

### 1. Crear Tarea
```
POST /api_create.php
Content-Type: application/json

{
  "title": "Mi tarea"
}

Response:
{
  "success": true,
  "data": { "id": 1, "title": "Mi tarea", "completed": false, ... }
}
```

### 2. Obtener Tareas
```
GET /api_read.php

Response:
{
  "success": true,
  "data": [
    { "id": 1, "title": "Mi tarea", "completed": false, ... }
  ]
}
```

### 3. Actualizar Tarea
```
POST /api_update.php
Content-Type: application/json

{
  "id": 1,
  "title": "Nuevo título",
  "completed": true
}

Response:
{
  "success": true,
  "data": { "id": 1, "title": "Nuevo título", "completed": true, ... }
}
```

### 4. Eliminar Tarea
```
POST /api_delete.php
Content-Type: application/json

{
  "id": 1
}

Response:
{
  "success": true
}
```

## 🔐 Seguridad

- ✅ PDO con prepared statements (protección contra SQL injection)
- ✅ Validación en backend
- ✅ Escapado de HTML en frontend
- ✅ Headers JSON apropiados
- ✅ Manejo de errores robusto

## 🆘 Solución de Problemas

### Error: "Cannot access database"
- Verifica que PostgreSQL esté corriendo
- Comprueba las credenciales en `db.php`
- Asegúrate de que la BD `todolist` existe

### Error: "404 Not Found"
- Verifica que la carpeta está en `C:\xampp\htdocs\`
- Asegúrate que Apache está corriendo
- Revisa la URL sea `http://localhost/crud_todolist/index.html`

### Las tareas no se guardan
- Revisa la consola del navegador (F12) para errores
- Verifica los logs de PHP en `C:\xampp\apache\logs\`
- Comprueba que PDO está habilitado en `php.ini`

### El modal no abre para editar
- Asegúrate que JavaScript esté habilitado
- Verifica que no hay errores en la consola (F12)

## 📚 Tecnologías Utilizadas

- **Frontend:**
  - HTML5 semántico
  - CSS3 (Grid, Flexbox, Glassmorphism)
  - JavaScript (Fetch API, ES6+)

- **Backend:**
  - PHP 7.4+
  - PDO (PHP Data Objects)
  - PostgreSQL 12+

- **Base de Datos:**
  - PostgreSQL
  - Índices optimizados

## ✨ Características Implementadas

- [x] CRUD completo
- [x] Filtros (Todas, Pendientes, Completadas)
- [x] Modal para editar títulos
- [x] Diseño responsivo
- [x] Animaciones suaves
- [x] Notificaciones toast
- [x] Contadores dinámicos
- [x] API RESTful con JSON
- [x] Validación en cliente y servidor
- [x] Protección contra XSS

## 🎓 Aprendizaje

Este proyecto demuestra:
- Arquitectura cliente-servidor
- CRUD operations
- Comunicación Fetch API
- Manejo de eventos en JavaScript
- Diseño responsivo y moderno
- Conexión a BDD con PDO
- RESTful API design
- Validación de datos

## 📄 Licencia

Proyecto libre para uso educativo y personal.

## 👨‍💻 Autor

Proyecto CRUD Todo List - 2026

---

📞 **¿Preguntas?** Revisa los comentarios en el código o consulta la documentación de PostgreSQL/PHP.

¡Feliz codificación! 🚀
