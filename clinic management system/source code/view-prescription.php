<?php
// Required includes
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>View Prescriptions</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>View Prescriptions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-10"></div>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                            <?php if($_SESSION['user'] == 'patient') { ?>
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Prescription ID</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Medicine Name</th>
                                            <th>Dosage</th>
                                            <th>Unit</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT p.*, 
                                                   pat.patientname, 
                                                   pro.name AS doctorname, 
                                                   med.medicinename
                                            FROM prescription p                                                 JOIN patient pat ON p.patient_id = pat.patientid
                                            JOIN professionals pro ON p.professional_id = pro.professional_id
                                            JOIN medicine med ON p.medicine_id = med.medicineid where patientid = '$_SESSION[patientid]'"  ;

                                        $qsql = mysqli_query($conn, $sql);
                                        while ($rs = mysqli_fetch_array($qsql)) {
                                            echo "<tr>
                                                    <td>{$rs['prescription_id']}</td>
                                                    <td>{$rs['patientname']}</td>
                                                    <td>{$rs['doctorname']}</td>
                                                    <td>{$rs['medicinename']}</td>
                                                    <td>{$rs['dosage']}</td>
                                                    <td>{$rs['unit']}</td>
                                                    <td>{$rs['cost']}</td>
                                                    <td>{$rs['prescription_date']}</td>
                                                    <td>{$rs['status']}</td>
                                                    <td>{$rs['description']}</td>
                                                    <td>
                                                        <a href='print_prescription.php?id={$rs['prescription_id']}' class='btn btn-primary'>Print Report</a>
                                                    </td>
                                                  </tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Prescription ID</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Medicine Name</th>
                                            <th>Dosage</th>
                                            <th>Unit</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php } ?>
                                <?php if($_SESSION['user'] == 'doctor') { ?>
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Prescription ID</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Medicine Name</th>
                                            <th>Dosage</th>
                                            <th>Unit</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT p.*, 
                                                   pat.patientname, 
                                                   pro.name AS doctorname, 
                                                   med.medicinename
                                            FROM prescription p                                                 JOIN patient pat ON p.patient_id = pat.patientid
                                            JOIN professionals pro ON p.professional_id = pro.professional_id
                                            JOIN medicine med ON p.medicine_id = med.medicineid ";

                                        $qsql = mysqli_query($conn, $sql);
                                        while ($rs = mysqli_fetch_array($qsql)) {
                                            echo "<tr>
                                                    <td>{$rs['prescription_id']}</td>
                                                    <td>{$rs['patientname']}</td>
                                                    <td>{$rs['doctorname']}</td>
                                                    <td>{$rs['medicinename']}</td>
                                                    <td>{$rs['dosage']}</td>
                                                    <td>{$rs['unit']}</td>
                                                    <td>{$rs['cost']}</td>
                                                    <td>{$rs['prescription_date']}</td>
                                                    <td>{$rs['status']}</td>
                                                    <td>{$rs['description']}</td>
                                                    <td>
                                                        <a href='print_prescription.php?id={$rs['prescription_id']}' class='btn btn-primary'>Print Report</a>
                                                    </td>
                                                  </tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Prescription ID</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Medicine Name</th>
                                            <th>Dosage</th>
                                            <th>Unit</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
    var addButtonTrigger = function addButtonTrigger(el) {
        el.addEventListener('click', function () {
            var popupEl = document.querySelector('.' + el.dataset.for);
            popupEl.classList.toggle('popup--visible');
        });
    };

    Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
