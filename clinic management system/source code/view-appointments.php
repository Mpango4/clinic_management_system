<!-- Author Name: Nikhil Bhalerao +919423979339. 
PHP, Laravel and Codeignitor Developer
-->
<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_GET['id'])) {
  if ($_SESSION['user'] == 'patient') {
    $sql = "DELETE FROM appointment WHERE appointmentid='$_GET[id]'";
    $qsql = mysqli_query($conn, $sql);
  } else {
    $sql = "UPDATE appointment SET delete_status='1' WHERE appointmentid='$_GET[id]'";
    $qsql = mysqli_query($conn, $sql);
  }

  if(mysqli_affected_rows($conn) == 1) {
    echo '
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Success 
        </h3>
        <p>Appointment record deleted successfully</p>
        <p>
         <script>setTimeout(function() { location.href = "view-appointments.php"; }, 1500);</script>
        </p>
      </div>
    </div>';
  }
}

if(isset($_GET['approveid'])) {
  $sql = "UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
  $qsql = mysqli_query($conn, $sql);

  if(mysqli_affected_rows($conn) == 1) {
    echo '
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Success 
        </h3>
        <p>Appointment record approved successfully.</p>
        <p>
         <script>setTimeout(function() { location.href = "view-appointments.php"; }, 1500);</script>
        </p>
      </div>
    </div>';
  }
}

if(isset($_GET['delid'])) {
  echo '
  <div class="popup popup--icon -question js_question-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Sure
      </h3>
      <p>Are you sure to delete this record?</p>
      <p>
        <a href="view-appointments.php?id=' . $_GET['delid'] . '" class="button button--success" data-for="js_success-popup">Yes</a>
        <a href="view-appointments.php" class="button button--error" data-for="js_success-popup">No</a>
      </p>
    </div>
  </div>';
}
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
<h4>View Appointments Record</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>View Appointments Record</a>
</li>
<li class="breadcrumb-item"><a href="#">View Appointments Record</a>
</li>
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
<table id="dom-jqry" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th>Patient detail</th>
    <th>Appointment Date & Time</th>
    <th>Department</th>
    <th>Doctor</th>
    <th>Reason</th>
    <th>Status</th>
    <th><div align="center">Action</div></th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM appointment WHERE patientid='$_SESSION[patientid]' AND delete_status='0'";
if(isset($_SESSION['patientid'])) {
  $sql .= " AND patientid='$_SESSION[patientid]'";
}
$qsql = mysqli_query($conn, $sql);
while($rs = mysqli_fetch_array($qsql)) {
  $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]' AND delete_status='0'";
  $qsqlpat = mysqli_query($conn, $sqlpat);
  $rspat = mysqli_fetch_array($qsqlpat);
  
  $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]' AND delete_status='0'";
  $qsqldept = mysqli_query($conn, $sqldept);
  $rsdept = mysqli_fetch_array($qsqldept);

  $sqldoc = "SELECT * FROM professionals WHERE professional_id='$rs[professional_id]' AND delete_status='0'";
  $qsqldoc = mysqli_query($conn, $sqldoc);
  $rsdoc = mysqli_fetch_array($qsqldoc);

  echo "<tr>
      <td>&nbsp;{$rspat['patientname']}<br>&nbsp;{$rspat['mobileno']}</td>
      <td>&nbsp;" . date("d-M-Y", strtotime($rs['appointmentdate'])) . " &nbsp; " . date("H:i A", strtotime($rs['appointmenttime'])) . "</td>
      <td>&nbsp;{$rsdept['departmentname']}</td>
      <td>&nbsp;{$rsdoc['name']}</td>
      <td>&nbsp;{$rs['app_reason']}</td>
      <td>&nbsp;{$rs['status']}</td>
      <td><div align='center'>";
  if($rs['status'] != "Approved") {
    if(!(isset($_SESSION['patientid']))) {
      echo "<a href='view-pending-appointment.php?approveid={$rs['appointmentid']}&patientid={$rs['patientid']}' class='btn btn-xs btn-primary'>Approve</a>";
    }
    echo "  <a href='view-appointments.php?delid={$rs['appointmentid']}' class='btn btn-xs btn-danger'>Cancel</a>";
  } else {
    echo "<a href='patientreport.php?patientid={$rs['patientid']}&appointmentid={$rs['appointmentid']}' class='btn btn-xs btn-primary'>View Report</a>";
  }
  echo "</div></td></tr>";
}
?>
</tbody>
<tfoot>
<tr>
    <th>Patient detail</th>
    <th>Appointment Date & Time</th>
    <th>Department</th>
    <th>Doctor</th>
    <th>Reason</th>
    <th>Status</th>
    <th><div align="center">Action</div></th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>

<?php if(!empty($_SESSION['success'])) { ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h3>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
     <script>setTimeout(function() { location.href = 'view_user.php'; }, 1500);</script>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]); } ?>

<?php if(!empty($_SESSION['error'])) { ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h3>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
     <script>setTimeout(function() { location.href = 'view_user.php'; }, 1500);</script>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]); } ?>

<script>
var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
