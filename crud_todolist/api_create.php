<?php
/**
 * API para CREAR una nueva tarea
 * Endpoint: POST /api_create.php
 * Body: { "title": "Mi tarea" }
 */

header('Content-Type: application/json');

// Incluir conexión a la base de datos
require_once 'db.php';

// Obtener datos del body JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validar que se recibió el título
if (!isset($input['title']) || empty(trim($input['title']))) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'El título es requerido'
    ]);
    exit;
}

$title = trim($input['title']);

try {
    // Preparar y ejecutar la consulta INSERT
    $stmt = $pdo->prepare('
        INSERT INTO tasks (title, completed, created_at)
        VALUES (:title, false, CURRENT_TIMESTAMP)
        RETURNING id, title, completed, created_at
    ');
    
    $stmt->execute([
        ':title' => $title
    ]);
    
    $newTask = $stmt->fetch();
    
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Tarea creada exitosamente',
        'data' => $newTask
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al crear la tarea',
        'error' => $e->getMessage()
    ]);
}
