<?php
require_once('check_login.php');
include('connect.php');

if (isset($_GET['id'])) {
    $prescription_id = intval($_GET['id']);
    
    $sql = "SELECT p.*, 
                   pat.patientname, 
                   pro.name AS doctorname, 
                   med.medicinename
            FROM prescription p
            JOIN patient pat ON p.patient_id = pat.patientid
            JOIN professionals pro ON p.professional_id = pro.professional_id
            JOIN medicine med ON p.medicine_id = med.medicineid
            WHERE p.prescription_id = $prescription_id";
    
    $result = mysqli_query($conn, $sql);
    $prescription = mysqli_fetch_assoc($result);

    if ($prescription) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .report {
            width: 70%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .center {
            text-align: center;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="report">
        <h2>Prescription Report</h2>
        <table>
            <tr><th>Prescription ID</th><td><?php echo htmlspecialchars($prescription['prescription_id']); ?></td></tr>
            <tr><th>Patient Name</th><td><?php echo htmlspecialchars($prescription['patientname']); ?></td></tr>
            <tr><th>Doctor Name</th><td><?php echo htmlspecialchars($prescription['doctorname']); ?></td></tr>
            <tr><th>Medicine Name</th><td><?php echo htmlspecialchars($prescription['medicinename']); ?></td></tr>
            <tr><th>Dosage</th><td><?php echo htmlspecialchars($prescription['dosage']); ?></td></tr>
            <tr><th>Unit</th><td><?php echo htmlspecialchars($prescription['unit']); ?></td></tr>
            <tr><th>Cost</th><td><?php echo htmlspecialchars($prescription['cost']); ?></td></tr>
            <tr><th>Date</th><td><?php echo htmlspecialchars($prescription['prescription_date']); ?></td></tr>
            <tr><th>Status</th><td><?php echo htmlspecialchars($prescription['status']); ?></td></tr>
            <tr><th>Description</th><td><?php echo htmlspecialchars($prescription['description']); ?></td></tr>
        </table>
        <div class="center">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "<p>Prescription not found.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
