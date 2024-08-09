<?php
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
                                    <h4>Patient Report</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a>Patient Report</a></li>
                                    <li class="breadcrumb-item"><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-10">
                                <?php if (isset($useroles) && in_array("create_user", $useroles)) { ?>
                                    <a href="add_user.php"><button class="btn btn-primary pull-right">+ Add Users</button></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Patient Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#appointment" role="tab">Appointment Record</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#treatment" role="tab">Treatment Record</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#prescription" role="tab">Prescription Record</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs-left-content card-block">
                                        <div class="tab-pane active" id="profile" role="tabpanel">
                                            <p class="m-0">
                                                <?php
                                                $stmt = $conn->prepare("SELECT * FROM patient WHERE patientid=?");
                                                $stmt->bind_param('i', $_GET['patientid']);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $rspatient = $result->fetch_assoc();
                                                ?>
                                                <div class="table-responsive dt-responsive">
                                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                        <tbody>
                                                            <tr>
                                                                <th>Patient Name</th>
                                                                <td><?php echo htmlspecialchars($rspatient['patientname']); ?></td>
                                                                <th>Patient ID</th>
                                                                <td><?php echo htmlspecialchars($rspatient['patientid']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td><?php echo htmlspecialchars($rspatient['address']); ?></td>
                                                                <th>Gender</th>
                                                                <td><?php echo htmlspecialchars($rspatient['gender']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Contact Number</th>
                                                                <td><?php echo htmlspecialchars($rspatient['mobileno']); ?></td>
                                                                <th>Date Of Birth</th>
                                                                <td><?php echo htmlspecialchars($rspatient['dob']); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="appointment" role="tabpanel">
                                            <p class="m-0">
                                                <?php
                                                $stmt1 = $conn->prepare("SELECT MAX(appointmentid) FROM appointment WHERE patientid=? AND (status='Active' OR status='Approved')");
                                                $stmt1->bind_param('i', $_GET['patientid']);
                                                $stmt1->execute();
                                                $stmt1->bind_result($maxAppointmentId);
                                                $stmt1->fetch();
                                                $stmt1->close();

                                                if ($maxAppointmentId) {
                                                    $stmt2 = $conn->prepare("SELECT * FROM appointment WHERE appointmentid=?");
                                                    $stmt2->bind_param('i', $maxAppointmentId);
                                                    $stmt2->execute();
                                                    $result2 = $stmt2->get_result();
                                                    $rsappointment = $result2->fetch_assoc();
                                                    $stmt2->close();

                                                    $stmt3 = $conn->prepare("SELECT * FROM department WHERE departmentid=?");
                                                    $stmt3->bind_param('i', $rsappointment['departmentid']);
                                                    $stmt3->execute();
                                                    $result3 = $stmt3->get_result();
                                                    $rsdepartment = $result3->fetch_assoc();
                                                    $stmt3->close();

                                                    $stmt4 = $conn->prepare("SELECT * FROM professionals WHERE professional_id=?");
                                                    $stmt4->bind_param('i', $rsappointment['professional_id']);
                                                    $stmt4->execute();
                                                    $result4 = $stmt4->get_result();
                                                    $rsdoctor = $result4->fetch_assoc();
                                                    $stmt4->close();
                                                ?>
                                                    <div class="table-responsive dt-responsive">
                                                        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                            <tr>
                                                                <th>Department</th>
                                                                <td><?php echo htmlspecialchars($rsdepartment['departmentname']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Doctor</th>
                                                                <td><?php echo htmlspecialchars($rsdoctor['name']); ?> (<?php echo htmlspecialchars($rsdoctor['profession']); ?>)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Appointment Date</th>
                                                                <td><?php echo date("d-M-Y", strtotime($rsappointment['appointmentdate'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Appointment Time</th>
                                                                <td><?php echo date("h:i A", strtotime($rsappointment['appointmenttime'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Reason</th>
                                                                <td><?php echo htmlspecialchars($rsappointment['app_reason']); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td><?php echo htmlspecialchars($rsappointment['status']); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                <?php
                                                } else {
                                                    echo "No appointment record found.";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="treatment" role="tabpanel">
                                            <p class="m-0">
                                                <?php
                                                $stmt = $conn->prepare("SELECT * FROM treatment_record WHERE patientid=?");
                                                $stmt->bind_param('i', $_GET['patientid']);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if ($result->num_rows > 0) {
                                                    while ($rstreatment_records = $result->fetch_assoc()) {
                                                        $stmt1 = $conn->prepare("SELECT * FROM treatment WHERE treatmentid=?");
                                                        $stmt1->bind_param('i', $rstreatment_records['treatmentids']);
                                                        $stmt1->execute();
                                                        $result1 = $stmt1->get_result();
                                                        $rstreatment = $result1->fetch_assoc();
                                                        $stmt1->close();

                                                        $stmt2 = $conn->prepare("SELECT * FROM professionals WHERE professional_id=?");
                                                        $stmt2->bind_param('i', $rstreatment_records['professional_id']);
                                                        $stmt2->execute();
                                                        $result2 = $stmt2->get_result();
                                                        $rsdoctor = $result2->fetch_assoc();
                                                        $stmt2->close();
                                                ?>
                                                        <div class="table-responsive dt-responsive">
                                                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                                <tr>
                                                                    <th>Treatment Date</th>
                                                                    <td><?php echo date("d-M-Y", strtotime($rstreatment_records['treatment_date'])); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Doctor</th>
                                                                    <td><?php echo htmlspecialchars($rsdoctor['name']); ?> (<?php echo htmlspecialchars($rsdoctor['profession']); ?>)</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Treatment Type</th>
                                                                    <td><?php echo htmlspecialchars($rstreatment['treatmenttype']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Treatment Description</th>
                                                                    <td><?php echo htmlspecialchars($rstreatment_records['treatment_description']); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                <?php
                                                    }
                                                } else {
                                                    echo "No treatment record found.";
                                                }
                                                $stmt->close();
                                                ?>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="prescription" role="tabpanel">
                                        <p class="m-0">
                                                <?php
                                                $stmt = $conn->prepare("SELECT * FROM prescription WHERE patient_id=?");
                                                $stmt->bind_param('i', $_GET['patientid']);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if ($result->num_rows > 0) {
                                                    while ($rsprescription = $result->fetch_assoc()) {
                                                        $stmt1 = $conn->prepare("SELECT * FROM professionals WHERE professional_id=?");
                                                        $stmt1->bind_param('i', $rsprescription['professional_id']);
                                                        $stmt1->execute();
                                                        $result1 = $stmt1->get_result();
                                                        $rsdoctor = $result1->fetch_assoc();
                                                        $stmt1->close();

                                                        $stmt2 = $conn->prepare("SELECT * FROM medicine WHERE medicineid=?");
                                                        $stmt2->bind_param('i', $rsprescription['medicine_id']);
                                                        $stmt2->execute();
                                                        $result2 = $stmt2->get_result();
                                                        $rsmedicine = $result2->fetch_assoc();
                                                        $stmt2->close();
                                                ?>
                                                        <div class="table-responsive dt-responsive">
                                                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                                <tr>
                                                                    <th>Prescription Date</th>
                                                                    <td><?php echo date("d-M-Y", strtotime($rsprescription['prescription_date'])); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Doctor</th>
                                                                    <td><?php echo htmlspecialchars($rsdoctor['name']); ?> (<?php echo htmlspecialchars($rsdoctor['profession']); ?>)</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Medicine</th>
                                                                    <td><?php echo htmlspecialchars($rsmedicine['medicinename']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Dosage</th>
                                                                    <td><?php echo htmlspecialchars($rsprescription['dosage']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Cost</th>
                                                                    <td><?php echo htmlspecialchars($rsprescription['cost']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status</th>
                                                                    <td><?php echo htmlspecialchars($rsprescription['status']); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Description</th>
                                                                    <td><?php echo htmlspecialchars($rsprescription['description']); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                <?php
                                                    }
                                                } else {
                                                    echo "No prescription record found.";
                                                }
                                                $stmt->close();
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

