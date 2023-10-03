<?php
require_once '../../config/Database.php';

if (isset($_POST)) {

    $isInvalidInputs = false;
    $errorMessage = [
        'status' => false,
        'message' => "Somthing went wrong!",
    ];

    $parent = $_POST['slider_category'];
    $title = $_POST['slider_title'];
    $text = $_POST['slider_text'];
    $image = $_FILES['slider_image'];

    if (empty($title) || empty($text) || empty($image)) {
        $errorMessage = [
            'status' => false,
            'message' => "Invalid input(s) value.",
        ];
        $isInvalidInputs = true;
    }

    if ($isInvalidInputs) { 
        die(json_encode($errorMessage));
    }

    $baseDirectory = dirname(__DIR__, 2);
    $targetDirectory = "$baseDirectory/uploads/";
    $targetFile = $targetDirectory . basename($image["name"]);
    
    $database = new Database();

    $memberDataToInsert = [
        ':parent_id' => (int) $parent,
        ':title' => $title,
        ':text' => $text,
        ':image' => "uploads/" . basename($image["name"]),
    ];

    $queryStatus = $database->executeQuery(
        "INSERT INTO `sliders`(`category_id`, `image`, `title`, `text`) VALUES (:parent_id, :image, :title, :text)", 
        $memberDataToInsert
    );

    if ($queryStatus) {
        move_uploaded_file($image["tmp_name"], $targetFile);

        $errorMessage = [
            'status' => true,
            'message' => "New member sucessfully added!",
        ];
        
        exit(json_encode($errorMessage));
    }
}