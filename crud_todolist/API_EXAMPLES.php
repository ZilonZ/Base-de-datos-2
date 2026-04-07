<?php
/**
 * Ejemplos de Uso de la API CRUD
 * Este archivo muestra cómo usar la API desde PHP o cURL
 * NO ejecutar este archivo en el servidor, es solo referencia
 */

echo "=== EJEMPLOS DE USO DE LA API CRUD ===\n\n";

// Configuración
$apiBase = 'http://localhost/crud_todolist';

// ============================================================
// MÉTODO 1: Usando cURL (desde terminal/PHP)
// ============================================================

echo "MÉTODO 1: cURL\n";
echo "-------------------------------------------\n\n";

// Ejemplo 1: Crear tarea con cURL
echo "1. CREAR TAREA:\n";
echo "curl -X POST $apiBase/api_create.php \\\n";
echo "  -H \"Content-Type: application/json\" \\\n";
echo "  -d '{\"title\": \"Mi primera tarea\"}'\n\n";

// Ejemplo 2: Obtener todas las tareas
echo "2. OBTENER TAREAS:\n";
echo "curl -X GET $apiBase/api_read.php\n\n";

// Ejemplo 3: Actualizar tarea
echo "3. ACTUALIZAR TAREA:\n";
echo "curl -X POST $apiBase/api_update.php \\\n";
echo "  -H \"Content-Type: application/json\" \\\n";
echo "  -d '{\"id\": 1, \"title\": \"Tarea actualizada\", \"completed\": true}'\n\n";

// Ejemplo 4: Eliminar tarea
echo "4. ELIMINAR TAREA:\n";
echo "curl -X POST $apiBase/api_delete.php \\\n";
echo "  -H \"Content-Type: application/json\" \\\n";
echo "  -d '{\"id\": 1}'\n\n";

// ============================================================
// MÉTODO 2: Usando file_get_contents (desde PHP)
// ============================================================

echo "\nMÉTODO 2: file_get_contents (PHP)\n";
echo "-------------------------------------------\n\n";

?>

<?php
/**
 * FUNCIÓN PARA CONSUMIR LA API
 * Copia esta función a tu código
 */
?>

function callAPI($endpoint, $method = 'GET', $data = null) {
    $url = 'http://localhost/crud_todolist/' . $endpoint;
    
    $options = [
        'http' => [
            'method' => $method,
            'header' => 'Content-Type: application/json'
        ]
    ];
    
    if ($data !== null) {
        $options['http']['content'] = json_encode($data);
    }
    
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    
    return json_decode($response, true);
}

// Uso:
// $result = callAPI('api_create.php', 'POST', ['title' => 'Nueva tarea']);

?>

<?php
/**
 * EJEMPLOS DE USO EN CÓDIGO PHP
 */
?>

<?php
// ============================================================
// EJEMPLO 1: CREAR TAREA
// ============================================================
echo "EJEMPLO 1: Crear tarea desde PHP\n";
echo "<?php\n";
echo "\$data = ['title' => 'Comprar leche'];\n";
echo "\$url = 'http://localhost/crud_todolist/api_create.php';\n";
echo "\$options = [\n";
echo "    'http' => [\n";
echo "        'method' => 'POST',\n";
echo "        'header' => 'Content-Type: application/json',\n";
echo "        'content' => json_encode(\$data)\n";
echo "    ]\n";
echo "];\n";
echo "\$context = stream_context_create(\$options);\n";
echo "\$response = json_decode(file_get_contents(\$url, false, \$context), true);\n";
echo "\nif (\$response['success']) {\n";
echo "    echo 'Tarea creada: ' . \$response['data']['id'];\n";
echo "} else {\n";
echo "    echo 'Error: ' . \$response['message'];\n";
echo "}\n";
echo "?>\n\n";

// ============================================================
// EJEMPLO 2: OBTENER TAREAS
// ============================================================
echo "EJEMPLO 2: Obtener todas las tareas\n";
echo "<?php\n";
echo "\$url = 'http://localhost/crud_todolist/api_read.php';\n";
echo "\$response = json_decode(file_get_contents(\$url), true);\n";
echo "\nif (\$response['success']) {\n";
echo "    foreach (\$response['data'] as \$task) {\n";
echo "        echo \$task['id'] . ' - ' . \$task['title'] . '\\n';\n";
echo "    }\n";
echo "}\n";
echo "?>\n\n";

// ============================================================
// EJEMPLO 3: ACTUALIZAR TAREA
// ============================================================
echo "EJEMPLO 3: Actualizar tarea\n";
echo "<?php\n";
echo "\$data = [\n";
echo "    'id' => 1,\n";
echo "    'title' => 'Tarea actualizada',\n";
echo "    'completed' => true\n";
echo "];\n\n";
echo "\$url = 'http://localhost/crud_todolist/api_update.php';\n";
echo "\$options = [\n";
echo "    'http' => [\n";
echo "        'method' => 'POST',\n";
echo "        'header' => 'Content-Type: application/json',\n";
echo "        'content' => json_encode(\$data)\n";
echo "    ]\n";
echo "];\n\n";
echo "\$context = stream_context_create(\$options);\n";
echo "\$response = json_decode(file_get_contents(\$url, false, \$context), true);\n";
echo "?>\n\n";

// ============================================================
// EJEMPLO 4: ELIMINAR TAREA
// ============================================================
echo "EJEMPLO 4: Eliminar tarea\n";
echo "<?php\n";
echo "\$data = ['id' => 1];\n";
echo "\$url = 'http://localhost/crud_todolist/api_delete.php';\n";
echo "\$options = [\n";
echo "    'http' => [\n";
echo "        'method' => 'POST',\n";
echo "        'header' => 'Content-Type: application/json',\n";
echo "        'content' => json_encode(\$data)\n";
echo "    ]\n";
echo "];\n\n";
echo "\$context = stream_context_create(\$options);\n";
echo "\$response = json_decode(file_get_contents(\$url, false, \$context), true);\n";
echo "?>\n\n";

echo "-------------------------------------------\n\n";

// ============================================================
// MÉTODO 3: Usando JavaScript Fetch (Frontend)
// ============================================================

echo "MÉTODO 3: JavaScript (Frontend)\n";
echo "-------------------------------------------\n\n";

?>

// CREAR TAREA
async function createTask(title) {
    const response = await fetch('http://localhost/crud_todolist/api_create.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title })
    });
    return await response.json();
}

// OBTENER TAREAS
async function getTasks() {
    const response = await fetch('http://localhost/crud_todolist/api_read.php');
    return await response.json();
}

// ACTUALIZAR TAREA
async function updateTask(id, updates) {
    const response = await fetch('http://localhost/crud_todolist/api_update.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, ...updates })
    });
    return await response.json();
}

// ELIMINAR TAREA
async function deleteTask(id) {
    const response = await fetch('http://localhost/crud_todolist/api_delete.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    });
    return await response.json();
}

// USO:
// createTask('Mi tarea').then(result => console.log(result));
// getTasks().then(result => console.log(result));
// updateTask(1, { title: 'Actualizada', completed: true }).then(r => console.log(r));
// deleteTask(1).then(result => console.log(result));

<?php
echo "\n-------------------------------------------\n\n";

echo "=== RESPUESTAS ESPERADAS ===\n\n";

echo "CREATE - Response:\n";
echo json_encode([
    'success' => true,
    'message' => 'Tarea creada exitosamente',
    'data' => [
        'id' => 1,
        'title' => 'Mi tarea',
        'completed' => false,
        'created_at' => '2026-04-06 14:30:00'
    ]
], JSON_PRETTY_PRINT) . "\n\n";

echo "READ - Response:\n";
echo json_encode([
    'success' => true,
    'message' => 'Tareas obtenidas correctamente',
    'data' => [
        [
            'id' => 1,
            'title' => 'Mi tarea',
            'completed' => false,
            'created_at' => '2026-04-06 14:30:00'
        ]
    ]
], JSON_PRETTY_PRINT) . "\n\n";

echo "UPDATE - Response:\n";
echo json_encode([
    'success' => true,
    'message' => 'Tarea actualizada exitosamente',
    'data' => [
        'id' => 1,
        'title' => 'Mi tarea actualizada',
        'completed' => true,
        'created_at' => '2026-04-06 14:30:00'
    ]
], JSON_PRETTY_PRINT) . "\n\n";

echo "DELETE - Response:\n";
echo json_encode([
    'success' => true,
    'message' => 'Tarea eliminada exitosamente',
    'data' => ['id' => 1]
], JSON_PRETTY_PRINT) . "\n\n";

echo "ERROR - Response:\n";
echo json_encode([
    'success' => false,
    'message' => 'Error: Descripción del error'
], JSON_PRETTY_PRINT) . "\n\n";

echo "-------------------------------------------\n";
echo "NOTA: Este archivo es solo para referencia.\n";
echo "No ejecutar en el servidor.\n";
?>
