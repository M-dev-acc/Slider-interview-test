<?php
// require_once '../../config/Database.php';

$categorySlidersCollection = [];
$database = new Database();

$categoryCollection = $database->executeQuery("SELECT * from categories");

foreach ($categoryCollection as $category) {

    $queryParameters = [
        ':category_id' => $category['id'],
    ];
    $slidersCollection = $database->executeQuery(
        "SELECT * FROM sliders WHERE category_id=:category_id", 
        $queryParameters
    );
    $categorySlidersCollection[$category['name']] = $slidersCollection;
}

// echo json_encode(['results' => $categorySlidersCollection]);