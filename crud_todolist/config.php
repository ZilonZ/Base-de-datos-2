<?php
/**
 * Archivo de Configuración del Proyecto
 * config.php - Configuración centralizada
 */

// ============================================================
// CONFIGURACIÓN DE BASE DE DATOS
// ============================================================

// Host del servidor PostgreSQL
define('DB_HOST', 'localhost');

// Puerto de PostgreSQL (5432 es el puerto por defecto)
define('DB_PORT', '5432');

// Nombre de la base de datos
define('DB_NAME', 'todolist');

// Usuario de PostgreSQL
define('DB_USER', 'postgres');

// Contraseña de PostgreSQL
define('DB_PASSWORD', 'postgres');

// ============================================================
// CONFIGURACIÓN DE APLICACIÓN
// ============================================================

// URL base de la aplicación
define('APP_URL', 'http://localhost/crud_todolist');

// Mostrar errores en desarrollo (cambiar a false en producción)
define('DEBUG_MODE', true);

// ============================================================
// CONFIGURACIÓN DE SESIÓN
// ============================================================

// Tiempo de sesión (en segundos)
define('SESSION_TIMEOUT', 3600);

// ============================================================
// FUNCIONES AUXILIARES
// ============================================================

/**
 * Obtener la conexión a la base de datos
 * @return PDO Conexión a la base de datos
 */
function getDBConnection() {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        if (DEBUG_MODE) {
            die('Error: ' . $e->getMessage());
        } else {
            die('Error de conexión a la base de datos');
        }
    }
}

/**
 * Responder con JSON
 * @param bool $success Estado de la operación
 * @param string $message Mensaje de respuesta
 * @param array $data Datos opcionales
 * @param int $code Código HTTP
 */
function respondJSON($success, $message = '', $data = null, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    
    $response = [
        'success' => $success,
        'message' => $message
    ];
    
    if ($data !== null) {
        $response['data'] = $data;
    }
    
    echo json_encode($response);
    exit;
}
