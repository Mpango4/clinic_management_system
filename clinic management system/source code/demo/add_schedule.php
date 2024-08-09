<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professional_id = $_POST['professional_id'];
    $day_of_week = $_POST['day_of_week'];
    $time_slot = $_POST['time_slot'];

    $sql = "INSERT INTO schedule (professional_id, day_of_week, time_slot) VALUES ('$professional_id', '$day_of_week', '$time_slot')";

    if ($conn->query($sql) === TRUE) {
        echo "New schedule added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
