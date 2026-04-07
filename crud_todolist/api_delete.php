<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"])) {
    echo json_encode(["error" => "Falta id"]);
    exit;
}

$id = $data["id"];

$query = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
$query->execute(["id" => $id]);

echo json_encode(["success" => true]);