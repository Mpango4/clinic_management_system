<?php
// Required includes
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

if (isset($_POST['update'])) {
    $reminder_id = $_POST['reminder_id'];
    $last_date = $_POST['last_date'];
    $next_date = $_POST['next_date'];
    $status = $_POST['status'];

    $sql = "UPDATE reminders SET last_date='$last_date', next_date='$next_date', status='$status' WHERE reminder_id='$reminder_id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Reminder updated successfully'); window.location='view_reminders.php';</script>";
    } else {
        echo "<script>alert('Error updating reminder');</script>";
    }
}

if (isset($_GET['id'])) {
    $reminder_id = $_GET['id'];
    $sql = "SELECT * FROM reminders WHERE reminder_id='$reminder_id'";
    $result = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_array($result);
} else {
    header("Location: view_reminders.php");
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
                                    <h4>Edit Reminder</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Edit Reminder</a></li>
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
                            <form method="post" action="">
                                <input type="hidden" name="reminder_id" value="<?php echo $rs['reminder_id']; ?>">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Last Visit Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="last_date" value="<?php echo $rs['last_date']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Next Visit Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="next_date" value="<?php echo $rs['next_date']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="Active" <?php if($rs['status'] == 'Active') echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if($rs['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="update" class="btn btn-primary">Update Reminder</button>
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

<?php include('footer.php'); ?>
