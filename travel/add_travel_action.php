<?php
include '../db.php';

$user_id = $_POST['user_id'];
$flight_no = $_POST['flight_no'];
$airport_code = $_POST['airport_code'];
$datetime = $_POST['dept_arrival_datetime'];
$seat_no = $_POST['seat_no'];
$booking_ref = $_POST['booking_ref'];
$booking_status = $_POST['booking_status'];

$sql = "INSERT INTO travel_info (user_id, flight_no, airport_code, dept_arrival_datetime, seat_no, booking_ref, booking_status)
        VALUES ('$user_id', '$flight_no', '$airport_code', '$datetime', '$seat_no', '$booking_ref', '$booking_status')";

if ($conn->query($sql) === TRUE) {
    echo "Travel info submitted.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
