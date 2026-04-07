<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"])) {
    echo json_encode(["error" => "Falta id"]);
    exit;
}

$id = $data["id"];
$updates = [];
$params = ["id" => $id];

if (isset($data["title"])) {
    $updates[] = "title = :title";
    $params["title"] = $data["title"];
}

if (isset($data["completed"])) {
    $updates[] = "completed = :completed";
    $params["completed"] = $data["completed"];
}

if (empty($updates)) {
    echo json_encode(["error" => "No hay datos para actualizar"]);
    exit;
}

$query = $pdo->prepare("UPDATE tasks SET " . implode(", ", $updates) . " WHERE id = :id");
$query->execute($params);

echo json_encode(["success" => true]);