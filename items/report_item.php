<?php
include '../db.php';  // connect to database

$user_id = $_POST['user_id'];
$item_type = $_POST['item_type'];
$description = $_POST['description'];
$status = $_POST['status'];
$report_date = $_POST['report_date'];

// For found item only:
$location_found = isset($_POST['location_found']) ? $_POST['location_found'] : NULL;

$target_dir = "../uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // create folder if not exists
}

$item_photo = NULL;
if (isset($_FILES["item_photo"]) && $_FILES["item_photo"]["error"] == 0) {
    $file_name = time() . "_" . basename($_FILES["item_photo"]["name"]);
    $target_file = $target_dir . $file_name;
    move_uploaded_file($_FILES["item_photo"]["tmp_name"], $target_file);
    $item_photo = $file_name;
}

// Save to database
$sql = "INSERT INTO reported_items (user_id, item_type, description, status, report_date, location_found,item_photo)
        VALUES ('$user_id', '$item_type', '$description', '$status', '$report_date', '$location_found', '$item_photo')";

if ($conn->query($sql) === TRUE) {
    echo "$status item reported successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>