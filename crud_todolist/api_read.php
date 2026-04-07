<?php
header("Content-Type: application/json");
include "db.php";

$query = $pdo->query("SELECT * FROM tasks ORDER BY id DESC");
$tasks = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["success" => true, "data" => $tasks]);