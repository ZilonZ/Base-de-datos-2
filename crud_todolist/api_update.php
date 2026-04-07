<?php
/**
 * API para ACTUALIZAR una tarea
 * Endpoint: POST /api_update.php
 * Body: { "id": 1, "title": "Nuevo título", "completed": true }
 */

header('Content-Type: application/json');

// Incluir conexión a la base de datos
require_once 'db.php';

// Obtener datos del body JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validar que se recibió el ID
if (!isset($input['id']) || empty($input['id'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'El ID es requerido'
    ]);
    exit;
}

$id = intval($input['id']);
$title = isset($input['title']) ? trim($input['title']) : null;
$completed = isset($input['completed']) ? (bool)$input['completed'] : null;

// Validar que haya al menos un campo para actualizar
if ($title === null && $completed === null) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Debe proporcionar al menos un campo para actualizar'
    ]);
    exit;
}

try {
    // Construir la consulta UPDATE dinámicamente según los campos proporcionados
    $updateFields = [];
    $params = [':id' => $id];
    
    if ($title !== null && $title !== '') {
        $updateFields[] = 'title = :title';
        $params[':title'] = $title;
    }
    
    if ($completed !== null) {
        $updateFields[] = 'completed = :completed';
        $params[':completed'] = $completed;
    }
    
    if (empty($updateFields)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'El título no puede estar vacío'
        ]);
        exit;
    }
    
    $updateQuery = 'UPDATE tasks SET ' . implode(', ', $updateFields) . ' WHERE id = :id RETURNING id, title, completed, created_at';
    
    $stmt = $pdo->prepare($updateQuery);
    $stmt->execute($params);
    
    $updatedTask = $stmt->fetch();
    
    if ($updatedTask) {
        echo json_encode([
            'success' => true,
            'message' => 'Tarea actualizada exitosamente',
            'data' => $updatedTask
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Tarea no encontrada'
        ]);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar la tarea',
        'error' => $e->getMessage()
    ]);
}
