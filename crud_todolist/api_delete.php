<?php
/**
 * API para ELIMINAR una tarea
 * Endpoint: POST /api_delete.php
 * Body: { "id": 1 }
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

try {
    // Preparar y ejecutar la consulta DELETE
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id RETURNING id');
    
    $stmt->execute([':id' => $id]);
    
    $deletedTask = $stmt->fetch();
    
    if ($deletedTask) {
        echo json_encode([
            'success' => true,
            'message' => 'Tarea eliminada exitosamente',
            'data' => $deletedTask
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
        'message' => 'Error al eliminar la tarea',
        'error' => $e->getMessage()
    ]);
}
