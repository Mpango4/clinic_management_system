<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btn_submit'])) {
    if(isset($_GET['editid'])) {
        $sql = "UPDATE schedule SET professional_id='$_POST[professional_id]', day_of_week='$_POST[day_of_week]', time_slot='$_POST[time_slot]' WHERE schedule_id='$_GET[editid]'";
        if($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">Success</h3>
                <p>Schedule Updated Successfully</p>
                <p>
                 <?php echo "<script>setTimeout(\"location.href = 'view-schedule.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        } else {
            echo mysqli_error($conn);
        }   
    } else {
        $sql = "INSERT INTO schedule (professional_id, day_of_week, time_slot) VALUES ('$_POST[professional_id]', '$_POST[day_of_week]', '$_POST[time_slot]')";
        if($qsql = mysqli_query($conn, $sql)) {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">Success</h3>
                <p>Schedule Inserted Successfully</p>
                <p>
                 <?php echo "<script>setTimeout(\"location.href = 'view-schedule.php';\",1500);</script>"; ?>
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
    $sql = "SELECT * FROM schedule WHERE schedule_id='$_GET[editid]'";
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
<h4>Create Schedule</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Schedule</a></li>
<li class="breadcrumb-item"><a href="#">Create Schedule</a></li>
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
        <label class="col-sm-2 col-form-label">Professional:</label>
        <div class="col-sm-8">
            <select name="professional_id" id="professional_id" class="form-control" required>
                <option value="">-- Select Professional --</option>
                <?php
                $sql = "SELECT * FROM professionals WHERE status='Active' AND delete_status='0'";
                $qsql = mysqli_query($conn, $sql);
                while($rs = mysqli_fetch_array($qsql)) {
                    if($rs['professional_id'] == $rsedit['professional_id']) {
                        echo "<option value='{$rs['professional_id']}' selected>{$rs['name']} ({$rs['profession']})</option>";
                    } else {
                        echo "<option value='{$rs['professional_id']}'>{$rs['name']} ({$rs['profession']})</option>";
                    }
                }
                ?>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Day of the Week:</label>
        <div class="col-sm-8">
            <select name="day_of_week" id="day_of_week" class="form-control" required>
                <option value="">-- Select Day --</option>
                <option value="Monday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Monday') echo 'selected'; ?>>Monday</option>
                <option value="Tuesday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                <option value="Wednesday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                <option value="Thursday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                <option value="Friday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Friday') echo 'selected'; ?>>Friday</option>
                <option value="Saturday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Saturday') echo 'selected'; ?>>Saturday</option>
                <option value="Sunday" <?php if(isset($_GET['editid']) && $rsedit['day_of_week'] == 'Sunday') echo 'selected'; ?>>Sunday</option>
            </select>
            <span class="messages"></span>
        </div>        
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Time Slot:</label>
        <div class="col-sm-8">
            <input type="time" class="form-control" name="time_slot" id="time_slot" required value="<?php if(isset($_GET['editid'])) { echo $rsedit['time_slot']; } ?>">
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
