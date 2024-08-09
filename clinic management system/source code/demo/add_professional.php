<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $profession = $_POST['profession'];

    $sql = "INSERT INTO professionals (name, profession) VALUES ('$name', '$profession')";

    if ($conn->query($sql) === TRUE) {
        echo "New professional added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
