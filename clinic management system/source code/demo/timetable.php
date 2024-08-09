<?php
include('connect.php');

$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weekly Timetable</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Weekly Timetable</h2>

<table>
    <thead>
        <tr>
            <th>Time Slot</th>
            <?php foreach ($daysOfWeek as $day) { echo "<th>$day</th>"; } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $timeSlots = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00'];

        foreach ($timeSlots as $time) {
            echo "<tr>";
            echo "<td>" . date('h:i A', strtotime($time)) . "</td>";
            foreach ($daysOfWeek as $day) {
                $sql = "SELECT p.name as professional_name, p.profession 
                        FROM schedule s
                        LEFT JOIN professionals p ON s.professional_id = p.professional_id
                        WHERE s.day_of_week = '$day' AND s.time_slot = '$time'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<td>Professional: " . $row['professional_name'] . "<br>Profession: " . $row['profession'] . "</td>";
                } else {
                    echo "<td>Available</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>
