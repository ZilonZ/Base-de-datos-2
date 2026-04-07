<?php
/**
 * Conexión a Base de Datos PostgreSQL con PDO
 * Archivo: db.php
 */

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'todolist');
define('DB_USER', 'postgres');
define('DB_PASSWORD', 'postgres'); // Cambiar según tu contraseña de PostgreSQL

try {
    // Cadena de conexión DSN para PostgreSQL
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    
    // Crear conexión PDO
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    
    // Configurar atributos PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Manejo de errores de conexión
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Error de conexión a la base de datos',
        'error' => $e->getMessage()
    ]);
    exit;
}
