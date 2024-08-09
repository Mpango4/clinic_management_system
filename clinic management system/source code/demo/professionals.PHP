<?php include('connect.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Professionals</title>
</head>
<body>
    <h2>Add Professional</h2>
    <form method="post" action="add_professional.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="profession">Profession:</label>
        <input type="text" id="profession" name="profession" required><br><br>
        <input type="submit" value="Add Professional">
    </form>
</body>
</html>
