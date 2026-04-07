<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["title"])) {
    echo json_encode(["error" => "Falta title"]);
    exit;
}

$title = $data["title"];

$query = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
$query->execute(["title" => $title]);

echo json_encode(["success" => true]);