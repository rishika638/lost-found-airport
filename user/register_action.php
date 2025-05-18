<?php
include '../db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$type = $_POST['user_type'];

$sql = "INSERT INTO users (name, email, phone, user_type)
        VALUES ('$name', '$email', '$phone', '$type')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
if ($type == 'Passenger') {
    header("Location: ../travel/add_travel.php?user_id=$last_id");
    exit();
} else {
    echo "Staff registered. <a href='../index.html'>Go to Home</a>";
}}


$conn->close();
?>
