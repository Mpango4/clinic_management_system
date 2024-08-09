<?php include('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Schedule</title>
</head>
<body>
    <h2>Add Schedule</h2>
    <form method="post" action="add_schedule.php">
        <label for="professional">Professional:</label>
        <select id="professional" name="professional_id" required>
            <?php
            $sql = "SELECT * FROM professionals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['professional_id'] . "'>" . $row['name'] . " - " . $row['profession'] . "</option>";
                }
            }
            ?>
        </select><br><br>
        <label for="day_of_week">Day of the Week:</label>
        <select id="day_of_week" name="day_of_week" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select><br><br>
        <label for="time_slot">Time Slot:</label>
        <input type="time" id="time_slot" name="time_slot" required><br><br>
        <input type="submit" value="Add Schedule">
    </form>
</body>
</html>
(status !='') and