<?php

require_once '../../config/Database.php';

$database = new Database();
$membersList = $database->executeQuery("SELECT id, member_name AS text FROM members");

echo json_encode(['results' => $membersList]);