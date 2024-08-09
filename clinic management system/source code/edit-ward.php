<?php require_once('check_login.php'); ?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('connect.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $sql = "UPDATE wards SET 
                wardname='$_POST[wardname]', 
                description='$_POST[description]', 
                status='$_POST[status]' 
            WHERE wardid='$_POST[wardid]'";
    if ($qsql = mysqli_query($conn, $sql)) {
        echo "<script>alert('Ward record updated successfully.');</script>";
        echo "<script>window.location='view-wards.php';</script>";
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM wards WHERE wardid='$_GET[editid]'";
    $qsql = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_array($qsql);
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
                                    <h4>Edit Ward</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>Wards</a></li>
                                    <li class="breadcrumb-item"><a href="#">Edit Ward</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Ward</h5>
                        </div>
                        <div class="card-block">
                            <form method="post" action="">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Ward Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="wardname" value="<?php echo $rs['wardname']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" required><?php echo $rs['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control" required>
                                            <option value="Active" <?php if ($rs['status'] == 'Active') echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if ($rs['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                            <option value="Taken" <?php if ($rs['status'] == 'Taken') echo 'selected'; ?>>Taken</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="wardid" value="<?php echo $rs['wardid']; ?>">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
