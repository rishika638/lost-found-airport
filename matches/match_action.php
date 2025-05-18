<?php
include '../db.php';

$lost_id = $_POST['lost_item_id'];
$found_id = $_POST['found_item_id'];
$status = $_POST['match_status'];

$sql = "INSERT INTO matches (lost_item_id, found_item_id, match_status)
        VALUES ('$lost_id', '$found_id', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "✅ Match created successfully.<br><a href='../index.html'>Go back to Home</a>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>