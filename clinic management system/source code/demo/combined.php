<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btn_submit'])) {
    if(isset($_GET['editid'])) {
        $sql = "UPDATE professionals SET name='$_POST[name]', mobile_no='$_POST[mobile_no]', department_id='$_POST[department_id]', login_id='$_POST[login_id]', status='$_POST[status]', profession='$_POST[profession]', experience='$_POST[experience]', consultancy_charge='$_POST[consultancy_charge]' WHERE professional_id='$_GET[editid]'";
        if($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">Success</h3>
                <p>Professional Record Updated Successfully</p>
                <p>
                 <?php echo "<script>setTimeout(\"location.href = 'view-professionals.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        } else {
            echo mysqli_error($conn);
        }   
    } else {
        $passw = hash('sha256', $_POST['password']);
        function createSalt() {
            return '2123293dsj2hu2nikhiljdsd';
        }
        $salt = createSalt();
        $pass = hash('sha256', $salt . $passw);
        $sql = "INSERT INTO professionals (name, mobile_no, department_id, login_id, password, status, profession, experience, consultancy_charge) VALUES ('$_POST[name]', '$_POST[mobile_no]', '$_POST[department_id]', '$_POST[login_id]', '$pass', '$_POST[status]', '$_POST[profession]', '$_POST[experience]', '$_POST[consultancy_charge]')";
        if($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">Success</h3>
                <p>Professional Record Inserted Successfully</p>
                <p>
                 <?php echo "<script>setTimeout(\"location.href = 'view-doctor.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        } else {
            echo mysqli_error($conn);
        }
    }
}

if(isset($_GET['editid'])) {
    $sql = "SELECT * FROM professionals WHERE professional_id='$_GET[editid]'";
    $qsql = mysqli_query($conn, $sql);
    $rsedit = mysqli_fetch_array($qsql);    
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
<h4>Add Professional</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Professionals</a></li>
<li class="breadcrumb-item"><a href="#">Add Professional</a></li>
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
        <label class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name..." required value="<?php if(isset($_GET['editid'])) { echo $rsedit['name']; } ?>">
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Mobile No</label>
        <div class="col-sm-4">
            <input type="number" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter mobile number..." required value="<?php if(isset($_GET['editid'])) { echo $rsedit['mobile_no']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Department</label>
        <div class="col-sm-4">
            <select class="form-control" name="department_id" id="department_id" required>
                <option value="">-- Select One --</option>
                <?php
                    $sqldepartment = "SELECT * FROM department WHERE status='Active'";
                    $qsqldepartment = mysqli_query($conn, $sqldepartment);
                    while($rsdepartment = mysqli_fetch_array($qsqldepartment)) {
                        if($rsdepartment['departmentid'] == $rsedit['department_id']) {
                            echo "<option value='{$rsdepartment['departmentid']}' selected>{$rsdepartment['departmentname']}</option>";
                        } else {
                            echo "<option value='{$rsdepartment['departmentid']}'>{$rsdepartment['departmentname']}</option>";
                        }
                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Login Id</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" name="login_id" id="login_id" value="<?php if(isset($_GET['editid'])) { echo $rsedit['login_id']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

<?php 
if(!isset($_GET['editid'])) {
?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
            <input class="form-control" type="password" name="password" id="password" required>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
            <input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" required>
            <span class="messages" id="confirm-pw" style="color: red;"></span>
        </div>
    </div>
<?php } ?>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Profession</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" name="profession" id="profession" value="<?php if(isset($_GET['editid'])) { echo $rsedit['profession']; } ?>">
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Experience</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" name="experience" id="experience" value="<?php if(isset($_GET['editid'])) { echo $rsedit['experience']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Consultancy Charge</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" name="consultancy_charge" id="consultancy_charge" value="<?php if(isset($_GET['editid'])) { echo $rsedit['consultancy_charge']; } ?>">
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-4">
            <select name="status" id="status" class="form-control" required>
                <option value="">-- Select One --</option>
                <option value="Active" <?php if(isset($_GET['editid']) && $rsedit['status'] == 'Active') { echo 'selected'; } ?>>Active</option>
                <option value="Inactive" <?php if(isset($_GET['editid']) && $rsedit['status'] == 'Inactive') { echo 'selected'; } ?>>Inactive</option>
            </select>
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
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php');?>

<script type="text/javascript">
    $('#main').keyup(function(){
        $('#confirm-pw').html('');
    });

    $('#cnfirmpassword').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });

    $('#password').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });
</script>
