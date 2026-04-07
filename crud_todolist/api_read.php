<?php
/**
 * API para LEER todas las tareas
 * Endpoint: GET /api_read.php
 * Retorna tareas ordenadas por id DESC
 */

header('Content-Type: application/json');

// Incluir conexión a la base de datos
require_once 'db.php';

try {
    // Preparar y ejecutar la consulta SELECT
    $stmt = $pdo->prepare('
        SELECT id, title, completed, created_at
        FROM tasks
        ORDER BY id DESC
    ');
    
    $stmt->execute();
    
    $tasks = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'message' => 'Tareas obtenidas correctamente',
        'data' => $tasks
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener las tareas',
        'error' => $e->getMessage()
    ]);
}
