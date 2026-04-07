<?php

$host = "localhost";
$port = "5432";
$dbname = "todolist";
$user = "postgres";
$password = "Zilonoy@19";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error conexión: " . $e->getMessage()]);
    exit;
}