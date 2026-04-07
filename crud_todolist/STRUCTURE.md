# 📚 Estructura del Proyecto - Explicación Detallada

## 📂 Árbol de Carpetas

```
crud_todolist/
│
├── Frontend Files (Interfaz)
│   ├── index.html          - Página principal HTML
│   ├── style.css           - Estilos CSS con glassmorphism
│   └── script.js           - Lógica JavaScript (fetch API)
│
├── Backend Files (API PHP)
│   ├── db.php              - Conexión a PostgreSQL con PDO
│   ├── config.php          - Configuración centralizada
│   ├── api_create.php      - Endpoint POST (CREATE)
│   ├── api_read.php        - Endpoint GET (READ)
│   ├── api_update.php      - Endpoint POST (UPDATE)
│   └── api_delete.php      - Endpoint POST (DELETE)
│
├── Database Files (Base de Datos)
│   └── database.sql        - Script SQL para PostgreSQL
│
├── Configuration Files
│   └── .htaccess           - Configuración de Apache
│
└── Documentation Files
    ├── README.md           - Documentación principal
    ├── INSTALL.md          - Guía de instalación
    ├── TESTING.md          - Guía de testing
    ├── API_EXAMPLES.php    - Ejemplos de uso API
    └── STRUCTURE.md        - Este archivo

```

---

## 📄 Descripción Detallada de Cada Archivo

### 🎨 ARCHIVOS FRONTEND

#### `index.html`
**¿Qué es?** La página HTML principal de la aplicación.

**Contenido:**
- Estructura semántica HTML5
- Header con título
- Sección de input para agregar tareas
- Botones de filtro (Todas, Pendientes, Completadas)
- Contenedor de tareas
- Modal para editar tareas
- Toast para notificaciones

**Función:** Proporciona la estructura y diseño del CRUD.

---

#### `style.css`
**¿Qué es?** Archivo de estilos CSS puro (sin frameworks).

**Características:**
- Diseño glassmorphism moderno
- Variables CSS personalizadas (colores, transiciones)
- Responsive design (Mobile First)
- Animaciones suaves
- Modo oscuro elegante
- Grid y Flexbox para layout

**Secciones principales:**
- Variables de colores y transiciones
- Estilos base (reset CSS)
- Header y tipografía
- Input y botones
- Tarjetas de tareas (task-card)
- Modal
- Filtros
- Notificaciones toast
- Animaciones
- Media queries

**Tamaño:** ~35KB

---

#### `script.js`
**¿Qué es?** Lógica JavaScript que maneja el frontend.

**Responsabilidades:**
```
┌─────────────────────────┐
│   script.js             │
├─────────────────────────┤
│ • Event Listeners       │
│ • Fetch API (CORS)      │
│ • DOM Manipulation      │
│ • State Management      │
│ • Validaciones          │
│ • Notificaciones        │
└─────────────────────────┘
```

**Funciones principales:**
- `addTask()` - Agregar tarea al servidor
- `loadTasks()` - Cargar tareas del servidor
- `updateTask()` - Actualizar tarea
- `deleteTask()` - Eliminar tarea
- `renderTasks()` - Renderizar DOM
- `showToast()` - Mostrar notificaciones
- Filtros dinámicos

**Comunicación:**
```
Front-end (JavaScript)
    ↓ fetch POST/GET
Backend (PHP APIs)
    ↓ PDO Query
PostgreSQL BD
```

---

### 🔧 ARCHIVOS BACKEND

#### `db.php`
**¿Qué es?** Archivo de conexión a la base de datos.

**Contenido:**
```php
- Constantes de conexión (HOST, PORT, NAME, USER, PASS)
- Conexión PDO a PostgreSQL
- Manejo de excepciones
- Configuración de atributos PDO
```

**Importancia:** Todas las APIs incluyen este archivo con `require_once 'db.php'`

**Seguridad:**
- Usa PDO prepared statements
- Error mode: EXCEPTION

---

#### `config.php`
**¿Qué es?** Archivo de configuración centralizada del proyecto.

**Contiene:**
- Constantes de base de datos (alternativa a db.php)
- URL base de la aplicación
- Modos debug
- Funciones auxiliares: `getDBConnection()`, `respondJSON()`

**Ventaja:** Mantiene la configuración en un solo lugar.

---

#### `api_create.php`
**¿Qué es?** Endpoint REST para crear tareas.

**Método HTTP:** POST

**Body esperado:**
```json
{
  "title": "Mi tarea"
}
```

**Response exitoso:**
```json
{
  "success": true,
  "message": "Tarea creada exitosamente",
  "data": {
    "id": 1,
    "title": "Mi tarea",
    "completed": false,
    "created_at": "2026-04-06 14:30:00"
  }
}
```

**Validaciones:**
- ✓ Title no puede estar vacío
- ✓ Title se trimea (sin espacios)

**Query SQL:**
```sql
INSERT INTO tasks (title, completed, created_at)
VALUES (:title, false, CURRENT_TIMESTAMP)
RETURNING id, title, completed, created_at
```

---

#### `api_read.php`
**¿Qué es?** Endpoint REST para obtener todas las tareas.

**Método HTTP:** GET

**Response exitoso:**
```json
{
  "success": true,
  "message": "Tareas obtenidas correctamente",
  "data": [
    {
      "id": 1,
      "title": "Mi tarea",
      "completed": false,
      "created_at": "2026-04-06 14:30:00"
    }
  ]
}
```

**Query SQL:**
```sql
SELECT id, title, completed, created_at
FROM tasks
ORDER BY id DESC
```

**Orden:** DESC (más recientes primero)

---

#### `api_update.php`
**¿Qué es?** Endpoint REST para actualizar tareas.

**Método HTTP:** POST

**Body esperado:**
```json
{
  "id": 1,
  "title": "Nuevo título",
  "completed": true
}
```

**Campos actualizables:**
- `title` (VARCHAR 255)
- `completed` (BOOLEAN)

**Validaciones:**
- ✓ ID es requerido
- ✓ Al menos un campo debe actualizarse
- ✓ Title no puede estar vacío

**Query SQL (dinámico):**
```sql
UPDATE tasks 
SET title = :title, completed = :completed 
WHERE id = :id 
RETURNING id, title, completed, created_at
```

---

#### `api_delete.php`
**¿Qué es?** Endpoint REST para eliminar tareas.

**Método HTTP:** POST

**Body esperado:**
```json
{
  "id": 1
}
```

**Response exitoso:**
```json
{
  "success": true,
  "message": "Tarea eliminada exitosamente",
  "data": { "id": 1 }
}
```

**Validaciones:**
- ✓ ID es requerido

**Query SQL:**
```sql
DELETE FROM tasks 
WHERE id = :id 
RETURNING id
```

---

### 💾 ARCHIVOS BASE DE DATOS

#### `database.sql`
**¿Qué es?** Script SQL para crear la BD y tabla en PostgreSQL.

**Contiene:**
```sql
1. CREATE DATABASE todolist;
2. CREATE TABLE tasks (
     id SERIAL PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     completed BOOLEAN DEFAULT FALSE,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
3. CREATE INDEX para optimización
4. INSERT de datos de prueba (opcional)
```

**Cómo usar:**
```bash
# Con psql
psql -U postgres -d todolist -f database.sql

# O copiando en pgAdmin Query Tool
```

---

### ⚙️ ARCHIVOS CONFIGURACIÓN

#### `.htaccess`
**¿Qué es?** Archivo de configuración de Apache.

**Funciones:**
- Habilitar CORS (Cross-Origin)
- Compresión Gzip
- Caché para archivos estáticos
- Protección de archivos sensibles
- mod_rewrite

**Ubicación:** Raíz del proyecto (htdocs/crud_todolist/)

---

### 📖 ARCHIVOS DOCUMENTACIÓN

#### `README.md`
**¿Qué es?** Documentación principal del proyecto.

**Secciones:**
- Descripción general
- Estructura del proyecto
- Requisitos previos
- Instalación paso a paso
- Uso de la aplicación
- Endpoints de la API
- Seguridad implementada
- Solución de problemas
- Tecnologías usadas

#### `INSTALL.md`
**¿Qué es?** Guía rápida de instalación.

**Objetivo:** Pasos simples para instalar en XAMPP.

**Contiene:**
- Preparar PostgreSQL
- Copiar archivos
- Iniciar servicios
- Errrores comunes y soluciones
- Checklist de verificación

#### `TESTING.md`
**¿Qué es?** Guía completa de testing.

**Tests incluidos:**
- CREATE (Crear tareas)
- READ (Leer/ver tareas)
- UPDATE (Actualizar tareas)
- DELETE (Eliminar tareas)
- Tests responsivos
- Tests de seguridad
- Tests de UX

#### `API_EXAMPLES.php`
**¿Qué es?** Ejemplos de uso de la API.

**Métodos mostrados:**
- cURL (terminal)
- file_get_contents (PHP)
- Fetch API (JavaScript)

**Ejemplos para:**
- crear tarea
- Obtener tareas
- Actualizar tarea
- Eliminar tarea

---

## 🔄 Flujo de Datos

```
┌─────────────────────────────────────────────────────────────┐
│                      USUARIO                                 │
└────────────────┬────────────────────────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────────────────────────┐
│              index.html + style.css                          │
│              (Interfaz Visual)                               │
├─────────────────────────────────────────────────────────────┤
│  • Header: "✓ My Tasks"                                      │
│  • Input: Agregar tarea                                      │
│  • Filtros: Todas, Pendientes, Completadas                  │
│  • Tarjetas: Mostrar tareas                                  │
└────────────────┬────────────────────────────────────────────┘
                 │
                 ▼ script.js (Fetch API)
                 │
        ┌────────┴────────┐
        │                 │
        ▼                 ▼
┌──────────────┐   ┌──────────────┐
│  JavaScript  │   │   JSON       │
│  Event       │   │   Request    │
│  Listeners   │   │/Response     │
└──────────────┘   └──────────────┘
        │
        ▼
┌─────────────────────────────────────────────────────────────┐
│                    BACKEND (PHP)                             │
├─────────────────────────────────────────────────────────────┤
│  api_create.php  | api_read.php                              │
│  api_update.php  | api_delete.php                            │
├─────────────────────────────────────────────────────────────┤
│  • JSON decode()                                             │
│  • Validación                                                │
│  • Prepared statements (PDO)                                 │
└────────────────┬────────────────────────────────────────────┘
                 │
                 ▼ db.php (PDO)
                 │
┌─────────────────────────────────────────────────────────────┐
│               PostgreSQL (Base de Datos)                     │
├─────────────────────────────────────────────────────────────┤
│  Database: todolist                                          │
│  Table: tasks                                                │
│  ┌────┬───────────┬───────────┬──────────────┐              │
│  │ id │   title   │ completed │  created_at  │              │
│  ├────┼───────────┼───────────┼──────────────┤              │
│  │ 1  │ Mi tarea  │   false   │ 2026-04-06   │              │
│  └────┴───────────┴───────────┴──────────────┘              │
└────────────────┬────────────────────────────────────────────┘
                 │
        ▼ JSON Response
        │
        ▼ script.js
        │
        ▼ renderTasks()
        │
        ▼ DOM Update
        │
        ▼ Browser Display
        │
        ▼ USUARIO VE LOS CAMBIOS
```

---

## 🔒 Capas de Seguridad

```
Frontend (script.js)
    ▼ Validación
├─ Escapar HTML (XSS prevention)
├─ Validar campos
├─ Confirmar antes de eliminar

Backend (PHP APIs)
    ▼ Validación & Seguridad
├─ header('Content-Type: application/json')
├─ PDO prepared statements (SQL injection prevention)
├─ Validación de datos
├─ Error handling

Database (PostgreSQL)
    ▼ Schema
├─ Tipos de datos estrictos
├─ Constraints (NOT NULL, DEFAULT)
├─ Índices para performance
```

---

## 📊 Tamaño de Archivos

| Archivo | Líneas | Tamaño |
|---------|--------|--------|
| index.html | ~80 | ~4 KB |
| style.css | ~550 | ~35 KB |
| script.js | ~330 | ~18 KB |
| db.php | ~25 | ~1 KB |
| api_create.php | ~45 | ~2 KB |
| api_read.php | ~25 | ~1 KB |
| api_update.php | ~60 | ~3 KB |
| api_delete.php | ~40 | ~2 KB |
| config.php | ~55 | ~3 KB |
| database.sql | ~35 | ~2 KB |
| **TOTAL** | **1,245** | **~80 KB** |

---

## ✅ Checklist de Archivos

- [x] index.html - Estructura HTML
- [x] style.css - Estilos CSS
- [x] script.js - Lógica JavaScript
- [x] db.php - Conexión BD
- [x] api_create.php - Crear
- [x] api_read.php - Leer
- [x] api_update.php - Actualizar
- [x] api_delete.php - Eliminar
- [x] database.sql - Script SQL
- [x] .htaccess - Configuración Apache
- [x] config.php - Configuración centralizada
- [x] README.md - Documentación
- [x] INSTALL.md - Instalación
- [x] TESTING.md - Testing
- [x] API_EXAMPLES.php - Ejemplos
- [x] STRUCTURE.md - Este documento

---

## 🚀 ¿Listo?

Todo está configurado. Solo necesitas:

1. **Instalar PostgreSQL** y crear la BD
2. **Copiar carpeta** a `C:\xampp\htdocs\`
3. **Iniciar Apache + PostgreSQL**
4. **Abrir navegador** → `http://localhost/crud_todolist/`

**¡Que disfrutes el proyecto!** 🎉

---

*Última actualización: 2026-04-06*
