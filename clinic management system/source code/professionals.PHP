<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btn_submit'])) {
    if(isset($_GET['editid'])) {
        $sql = "UPDATE professionals SET name='$_POST[name]', profession='$_POST[profession]', status='$_POST[status]' WHERE professional_id='$_GET[editid]'";
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
        $sql = "INSERT INTO professionals (name, profession, status) VALUES ('$_POST[name]', '$_POST[profession]', '$_POST[status]')";
        if($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">Success</h3>
                <p>Professional Record Inserted Successfully</p>
                <p>
                 <?php echo "<script>setTimeout(\"location.href = 'view-professionals.php';\",1500);</script>"; ?>
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
<h4>Add New Professional</h4>
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
        <label class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter professional's name..." required value="<?php if(isset($_GET['editid'])) { echo $rsedit['name']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Profession:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="profession" id="profession" placeholder="Enter profession..." required value="<?php if(isset($_GET['editid'])) { echo $rsedit['profession']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-8">
            <select name="status" id="status" class="form-control" required>
                <option value="">-- Select Status --</option>
                <option value="Active" <?php if(isset($_GET['editid']) && $rsedit['status'] == 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if(isset($_GET['editid']) && $rsedit['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
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
