<?php
header("Content-Type: application/json");

$host = "localhost";
$port = "5432";
$dbname = "todolist";
$user = "postgres";
$password = "postgres";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = $pdo->query("SELECT * FROM tasks");
    $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        "success" => true,
        "message" => "Conexión exitosa",
        "tasks_count" => count($tasks),
        "tasks" => $tasks
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
?>
