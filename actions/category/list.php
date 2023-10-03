<?php

require_once '../../config/Database.php';

$database = new Database();
$categoryList = $database->executeQuery("SELECT id, name AS text FROM categories");

echo json_encode(['results' => $categoryList], JSON_PRETTY_PRINT);
