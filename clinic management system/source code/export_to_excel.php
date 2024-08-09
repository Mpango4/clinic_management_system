<?php
require_once('check_login.php');
include('connect.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the headers
$sheet->setCellValue('A1', 'Patient Name');
$sheet->setCellValue('B1', 'Admission Date');
$sheet->setCellValue('C1', 'Admission Time');
$sheet->setCellValue('D1', 'Address');
$sheet->setCellValue('E1', 'City');
$sheet->setCellValue('F1', 'Pincode');
$sheet->setCellValue('G1', 'Mobile No.');
$sheet->setCellValue('H1', 'Blood Group');
$sheet->setCellValue('I1', 'Gender');
$sheet->setCellValue('J1', 'DOB');
$sheet->setCellValue('K1', 'Status');

// Fetch data from the database
$sql = "SELECT * FROM patient WHERE delete_status='0'";
$result = mysqli_query($conn, $sql);
$rowCount = 2;

while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowCount, $row['patientname']);
    $sheet->setCellValue('B' . $rowCount, $row['admissiondate']);
    $sheet->setCellValue('C' . $rowCount, $row['admissiontime']);
    $sheet->setCellValue('D' . $rowCount, $row['address']);
    $sheet->setCellValue('E' . $rowCount, $row['city']);
    $sheet->setCellValue('F' . $rowCount, $row['pincode']);
    $sheet->setCellValue('G' . $rowCount, $row['mobileno']);
    $sheet->setCellValue('H' . $rowCount, $row['bloodgroup']);
    $sheet->setCellValue('I' . $rowCount, $row['gender']);
    $sheet->setCellValue('J' . $rowCount, $row['dob']);
    $sheet->setCellValue('K' . $rowCount, $row['status']);
    $rowCount++;
}

// Clear any previous output
ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="patients.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
