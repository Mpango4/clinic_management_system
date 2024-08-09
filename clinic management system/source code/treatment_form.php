<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if(isset($_POST['btn_submit'])) {
    $treatment_ids = implode(',', $_POST['treatmentid']); // Store treatment IDs as a comma-separated string
    $sql = "INSERT INTO treatment_record (treatmentids, patientid, professional_id, treatment_description, treatment_date, treatment_time, status) VALUES ('$treatment_ids', '$_POST[patientid]', '$_POST[professional_id]', '$_POST[treatment_description]', '$_POST[treatment_date]', '$_POST[treatment_time]', 'Active')";
    if($qsql = mysqli_query($conn, $sql)) {
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">Success</h3>
            <p>Treatment Record Added Successfully</p>
            <p>
             <?php echo "<script>setTimeout(\"location.href = 'view-treatment-record.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
    } else {
        echo mysqli_error($conn);
    }
}

if(isset($_POST['btn_prescription'])) {
    $medicine_ids = $_POST['medicine_id'];
    foreach($medicine_ids as $medicine_id) {
        $sql = "INSERT INTO prescription (treatment_records_id, professional_id, patient_id, prescription_date, medicine_id, cost, unit, dosage, status, description) VALUES ('$_POST[treatment_records_id]', '$_POST[professional_id]', '$_POST[patient_id]', '$_POST[prescription_date]', '$medicine_id', '$_POST[cost]', '$_POST[unit]', '$_POST[dosage]', 'active', '$_POST[description]')";
        if(!$qsql = mysqli_query($conn, $sql)) {
            echo mysqli_error($conn);
            break;
        }
    }
?>
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">Success</h3>
        <p>Prescription Added Successfully</p>
        <p>
         <?php echo "<script>setTimeout(\"location.href = 'view-prescription.php';\",1500);</script>"; ?>
        </p>
      </div>
    </div>
<?php
}

if(isset($_POST['btn_reminder'])) {
    $sql = "INSERT INTO reminders (patientid, last_date, next_date) VALUES ('$_POST[patientid]', '$_POST[last_date]', '$_POST[next_date]')";
    if($qsql = mysqli_query($conn, $sql)) {
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">Success</h3>
            <p>Reminder Added Successfully</p>
            <p>
             <?php echo "<script>setTimeout(\"location.href = 'view-prescription.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
    } else {
        echo mysqli_error($conn);
    }
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
<h4>Add Treatment Record</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Treatment Records</a></li>
<li class="breadcrumb-item"><a href="#">Add Treatment Record</a></li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
</div>
<div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Treatment Type</label>
        <div class="col-sm-4">
            <select class="form-control" name="treatmentid[]" id="treatmentid" multiple required>
                <option value="">-- Select One --</option>
                <?php
                    $sqltreatment = "SELECT * FROM treatment WHERE status='Active'";
                    $qsqtreatment = mysqli_query($conn, $sqltreatment);
                    while($rstreatment = mysqli_fetch_array($qsqtreatment)) {
                        echo "<option value='{$rstreatment['treatmentid']}'>{$rstreatment['treatmenttype']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Patient</label>
        <div class="col-sm-4">
            <select class="form-control" name="patientid" id="patientid" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqlpatient = "SELECT * FROM patient WHERE status='Active'";
                    $qsqlpatient = mysqli_query($conn, $sqlpatient);
                    while($rspatient = mysqli_fetch_array($qsqlpatient)) {
                        echo "<option value='{$rspatient['patientid']}'>{$rspatient['patientname']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Professional</label>
        <div class="col-sm-4">
            <select class="form-control" name="professional_id" id="professional_id" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqlprofessional = "SELECT * FROM professionals WHERE status='Active'";
                    $qsqlprofessional = mysqli_query($conn, $sqlprofessional);
                    while($rsprofessional = mysqli_fetch_array($qsqlprofessional)) {
                        echo "<option value='{$rsprofessional['professional_id']}'>{$rsprofessional['name']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Treatment Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="treatment_date" id="treatment_date" required>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Treatment Time</label>
        <div class="col-sm-4">
            <input type="time" class="form-control" name="treatment_time" id="treatment_time" required>
            <span class="messages"></span>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Treatment Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="treatment_description" id="treatment_description" required></textarea>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>
</form>
</div>
</div>

<!-- Prescription Form -->
<div class="card">
<div class="card-header">
<h4>Add Prescription</h4>
</div>
<div class="card-block">
<form id="prescriptionForm" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Treatment Record</label>
        <div class="col-sm-4">
            <select class="form-control" name="treatment_records_id" id="treatment_records_id" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqltreatmentrecords = "SELECT * FROM treatment_record WHERE status='Active'";
                    $qsqtreatmentrecords = mysqli_query($conn, $sqltreatmentrecords);
                    while($rstreatmentrecords = mysqli_fetch_array($qsqtreatmentrecords)) {
                        echo "<option value='{$rstreatmentrecords['recordid']}'>{$rstreatmentrecords['treatment_description']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Patient</label>
        <div class="col-sm-4">
            <select class="form-control" name="patient_id" id="patient_id" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqlpatient = "SELECT * FROM patient WHERE status='Active'";
                    $qsqlpatient = mysqli_query($conn, $sqlpatient);
                    while($rspatient = mysqli_fetch_array($qsqlpatient)) {
                        echo "<option value='{$rspatient['patientid']}'>{$rspatient['patientname']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Professional</label>
        <div class="col-sm-4">
            <select class="form-control" name="professional_id" id="professional_id" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqlprofessional = "SELECT * FROM professionals WHERE status='Active'";
                    $qsqlprofessional = mysqli_query($conn, $sqlprofessional);
                    while($rsprofessional = mysqli_fetch_array($qsqlprofessional)) {
                        echo "<option value='{$rsprofessional['professional_id']}'>{$rsprofessional['name']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Prescription Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="prescription_date" id="prescription_date" required>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Medicine</label>
        <div class="col-sm-4">
            <select class="form-control" name="medicine_id[]" id="medicine_id" multiple required>
                <option value="">-- Select One --</option>
                <?php
                    $sqlmedicine = "SELECT * FROM medicine WHERE status='Active'";
                    $qsqlmedicine = mysqli_query($conn, $sqlmedicine);
                    while($rsmedicine = mysqli_fetch_array($qsqlmedicine)) {
                        echo "<option value='{$rsmedicine['medicineid']}'>{$rsmedicine['medicinename']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Cost</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="cost" id="cost" required>
            <span class="messages"></span>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Unit</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="unit" id="unit" required>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Dosage</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="dosage" id="dosage" required>
            <span class="messages"></span>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description" required></textarea>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_prescription" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>
</form>
</div>
</div>

<!-- Reminder Form -->
<div class="card">
<div class="card-header">
<h4>Add Reminder</h4>
</div>
<div class="card-block">
<form id="reminderForm" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Patient</label>
        <div class="col-sm-4">
            <select class="form-control" name="patientid" id="patientid" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqlpatient = "SELECT * FROM patient WHERE status='Active'";
                    $qsqlpatient = mysqli_query($conn, $sqlpatient);
                    while($rspatient = mysqli_fetch_array($qsqlpatient)) {
                        echo "<option value='{$rspatient['patientid']}'>{$rspatient['patientname']}</option>";
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Last Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="last_date" id="last_date" required>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Next Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="next_date" id="next_date" required>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_reminder" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php');?>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('treatment_description');
    CKEDITOR.replace('description');
</script>
