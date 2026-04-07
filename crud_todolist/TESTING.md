# 🧪 Guía de Testing - Todo List CRUD

Instrucciones para probar todas las funcionalidades del proyecto CRUD.

## ✅ Pre-requisitos

- [ ] Apache corriendo (verde en XAMPP)
- [ ] PostgreSQL corriendo (verde en XAMPP)
- [ ] La app carga en `http://localhost/crud_todolist/index.html`
- [ ] Navegador moderno (Chrome, Firefox, Edge)
- [ ] Consola abierta (F12)

---

## 🚀 Tests a Realizar

### 1️⃣ TEST - Crear Tareas (CREATE)

**Paso 1: Agregar tarea normal**
1. Abre la app
2. Escribe en el input: `"Comprar leche"`
3. Haz click en "+Agregar" o presiona ENTER
4. **Resultado esperado:** 
   - ✓ Notificación verde: "Tarea agregada exitosamente"
   - ✓ La tarea aparece en la lista
   - ✓ Input se limpia
   - ✓ Contador "Todas" aumenta en 1

**Paso 2: Agregar sin escribir nada**
1. Deja el input vacío
2. Haz click en "+Agregar"
3. **Resultado esperado:**
   - ✓ Notificación roja: "Por favor, escribe una tarea"
   - ✓ No se crea nada

**Paso 3: Agregar múltiples tareas**
1. Agrega 5 tareas diferentes
2. **Resultado esperado:**
   - ✓ Todas aparecen en la lista
   - ✓ Aparecer en orden de más reciente a más antigua
   - ✓ Cada una tiene timestamp diferente
   - ✓ Contador "Todas" es 5

---

### 2️⃣ TEST - Leer/Ver Tareas (READ)

**Paso 1: Ver todas las tareas**
1. La app ya debe mostrar todas las tareas creadas
2. **Resultado esperado:**
   - ✓ Todas las tareas están visibles
   - ✓ Ordenadas por más reciente primero (ID descendente)
   - ✓ Cada tarea muestra su fecha y hora

**Paso 2: Verificar filtro "Todas"**
1. Haz click en el botón "Todas"
2. **Resultado esperado:**
   - ✓ Botón se pone azul (activo)
   - ✓ Muestra todas las tareas creadas
   - ✓ El contador debe ser correcto

**Paso 3: Verificar filtro "Pendientes"**
1. Haz click en "Pendientes"
2. **Resultado esperado:**
   - ✓ Solo muestra tareas NO completadas
   - ✓ Contador es correcto (pendientes)
   - ✓ Las completadas no aparecen

**Paso 4: Verificar filtro "Completadas"**
1. Haz click en "Completadas"
2. **Resultado esperado:**
   - ✓ Solo muestra tareas completadas
   - ✓ Contador es correcto
   - ✓ Las tareas sin completar no aparecen

**Paso 5: Estado vacío**
1. Estando en "Completadas", si no hay completadas
2. **Resultado esperado:**
   - ✓ Mensaje: "No hay tareas por mostrar"
   - ✓ Emoji 📝 visible

---

### 3️⃣ TEST - Actualizar Tareas (UPDATE)

**Paso 1: Marcar como completada**
1. Ve a "Todas"
2. Haz click en la casilla (checkbox) de una tarea
3. **Resultado esperado:**
   - ✓ Aparece checkmark ✓ en la casilla
   - ✓ La tarea se ve más opaca y con tachado
   - ✓ Contador "Todas" se mantiene igual
   - ✓ Contador "Completadas" aumenta
   - ✓ Contador "Pendientes" disminuye
   - ✓ Notificación verde: "Tarea actualizada"

**Paso 2: Desmarcar como completada**
1. Haz click nuevamente en el checkbox de esa tarea
2. **Resultado esperado:**
   - ✓ El checkmark desaparece
   - ✓ La tarea vuelve a verse normal
   - ✓ Los contadores se actualizan correctamente

**Paso 3: Editar título de una tarea**
1. Haz click en el botón ✏️ (lápiz) de una tarea
2. **Resultado esperado:**
   - ✓ Se abre un modal
   - ✓ El campo de texto contiene el título actual

**Paso 4: Cambiar el título**
1. En el modal, limpia el texto y escribe uno nuevo
2. Haz click en "Guardar Cambios" o presiona ENTER
3. **Resultado esperado:**
   - ✓ Modal se cierra
   - ✓ La tarea en la lista muestra el nuevo título
   - ✓ Notificación verde: "Tarea actualizada"

**Paso 5: Cancelar edición**
1. Haz click en ✏️ de otra tarea
2. Cambia el título
3. Haz click en "Cancelar"
4. **Resultado esperado:**
   - ✓ Modal se cierra
   - ✓ La tarea NO cambia
   - ✓ Los datos permanecen igual

**Paso 6: Cerrar modal sin guardar**
1. Abre el modal (click en ✏️)
2. Hace click en la X (esquina superior derecha)
3. **Resultado esperado:**
   - ✓ Modal se cierra sin guardar cambios

**Paso 7: Editar con campo vacío**
1. Abre el modal
2. Limpia completamente el campo
3. Haz click en "Guardar Cambios"
4. **Resultado esperado:**
   - ✓ Notificación roja: "El título no puede estar vacío"
   - ✓ Modal sigue abierto
   - ✓ Nada se guarda

---

### 4️⃣ TEST - Eliminar Tareas (DELETE)

**Paso 1: Eliminar una tarea**
1. Haz click en el botón 🗑️ (basurero) de una tarea
2. **Resultado esperado:**
   - ✓ Aparece confirmación: "¿Estás seguro de que deseas eliminar?"

**Paso 2: Confirmar eliminación**
1. Haz click en "OK" en el diálogo
2. **Resultado esperado:**
   - ✓ La tarea desaparece de la lista
   - ✓ Notificación verde: "Tarea eliminada"
   - ✓ Contador "Todas" disminuye en 1
   - ✓ Si era una tarea pendiente, "Pendientes" disminuye

**Paso 3: Cancelar eliminación**
1. Haz click en 🗑️ de otra tarea
2. Haz click en "Cancelar" en el diálogo
3. **Resultado esperado:**
   - ✓ La tarea NO se elimina
   - ✓ Sigue en la lista igual

---

## 📱 TEST - Diseño Responsivo

### Desktop (1920px+)
1. Abre la app en pantalla completa
2. **Verificar:**
   - ✓ Todo se ve bien espaciado
   - ✓ Las tarjetas se ven bonitas
   - ✓ Glassmorphism se ve elegante

### Tablet (768px - 1024px)
1. Abre DevTools (F12)
2. Usa "Device Toolbar" (Ctrl+Shift+M)
3. Selecciona iPad o tablet
4. **Verificar:**
   - ✓ El layout se adapta
   - ✓ Los botones son fáciles de hacer click
   - ✓ Las tareas se ven bien

### Mobile (360px - 480px)
1. En DevTools, selecciona "iPhone 12" o similar
2. **Verificar:**
   - ✓ Todo es legible en móvil
   - ✓ Los inputs y botones son del tamaño correcto
   - ✓ Las tareas se apilan correctamente
   - ✓ El modal se ve bien

---

## 🌐 TEST - API Endpoints

Abre Postman o insomnia y prueba:

### Test 1: Crear tarea (POST)
```
POST http://localhost/crud_todolist/api_create.php
Headers: Content-Type: application/json

Body:
{
  "title": "Tarea de prueba API"
}

Respuesta esperada:
{
  "success": true,
  "message": "Tarea creada exitosamente",
  "data": { "id": ..., "title": "...", "completed": false }
}
```

### Test 2: Leer tareas (GET)
```
GET http://localhost/crud_todolist/api_read.php

Respuesta esperada:
{
  "success": true,
  "message": "Tareas obtenidas correctamente",
  "data": [...]
}
```

### Test 3: Actualizar tarea (POST)
```
POST http://localhost/crud_todolist/api_update.php
Headers: Content-Type: application/json

Body:
{
  "id": 1,
  "title": "Nuevo título",
  "completed": true
}

Respuesta esperada:
{
  "success": true,
  "message": "Tarea actualizada exitosamente",
  "data": { "id": 1, ... }
}
```

### Test 4: Eliminar tarea (POST)
```
POST http://localhost/crud_todolist/api_delete.php
Headers: Content-Type: application/json

Body:
{
  "id": 1
}

Respuesta esperada:
{
  "success": true,
  "message": "Tarea eliminada exitosamente"
}
```

---

## 🔒 TEST - Seguridad

### Test 1: SQL Injection
1. Intenta crear una tarea con: `"; DROP TABLE tasks; --`
2. **Resultado esperado:**
   - ✓ La tarea se crea normalmente (como texto)
   - ✓ La tabla tasks NO se elimina
   - ✓ PDO previene el ataque

### Test 2: XSS (Cross-Site Scripting)
1. Crea una tarea con: `<script>alert('XSS')</script>`
2. **Resultado esperado:**
   - ✓ No aparece alerta
   - ✓ El script se muestra como texto HTML escapado

### Test 3: Campos vacíos
1. Intenta actualizar sin campo title o completed
2. **Resultado esperado:**
   - ✓ Se recibe error apropiado
   - ✓ La tarea no cambia

---

## 📊 TEST - Consola del Navegador

1. Abre la consola (F12 → Console)
2. Realiza todas las operaciones CRUD
3. **Verificar:**
   - ✓ No hay errores en rojo
   - ✓ Las requests se ven en Network tab
   - ✓ Los responses son JSON válido

---

## ✨ TEST - Experiencia del Usuario

### Animaciones
1. Abre la app
2. **Verificar:**
   - ✓ El header aparece con animación
   - ✓ Cuando se agrega una tarea, entra con slide
   - ✓ El modal abre con transición suave
   - ✓ Las notificaciones aparecen desde abajo

### Notificaciones
1. Realiza operaciones CRUD
2. **Verificar:**
   - ✓ Aparecen notificaciones apropiadas
   - ✓ Las de éxito son verdes
   - ✓ Las de error son rojas
   - ✓ Se cierran automáticamente en 3 segundos

### Indicadores Visuales
1. Marca una tarea como completada
2. **Verificar:**
   - ✓ Se ve tachada
   - ✓ La opacidad cambia
   - ✓ El checkbox muestra checkmark

---

## 📋 Checklist Final

- [ ] Create funciona
- [ ] Read funciona  
- [ ] Update funciona
- [ ] Delete funciona
- [ ] Filtros funcionan
- [ ] Contadores actualizan correctamente
- [ ] Diseño responsive
- [ ] Sin errores en consola
- [ ] Notificaciones funcionan
- [ ] Modal abre/cierra correctamente
- [ ] Animaciones se ven suaves
- [ ] API devuelve JSON correcto
- [ ] Seguridad: XSS y SQL Injection bloqueados

---

## 🎯 Si todo está en ✓

¡**Felicidades! El CRUD está completamente funcional y listo para producción.** 🚀

## ❌ Si algo falla

1. Abre la consola (F12)
2. Revisa los errores
3. Consulta INSTALL.md para solucionar
4. Prueba nuevamente

---

¡Happy testing! 🧪✨
