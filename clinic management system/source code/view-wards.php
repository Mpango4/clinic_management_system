<!-- Author Name: Nikhil Bhalerao +919423979339. 
PHP, Laravel and Codeignitor Developer
-->
<?php require_once('check_login.php'); ?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('connect.php'); ?>

<?php
if(isset($_GET['id'])) {
    $sql = "UPDATE wards SET delete_status='1' WHERE wardid='$_GET[id]'";
    $qsql = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) == 1) {
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">Success</h3>
                <p>Ward record deleted successfully.</p>
                <p>
                    <?php echo "<script>setTimeout(\"location.href = 'view-wards.php';\",1500);</script>"; ?>
                </p>
            </div>
        </div>
<?php
    }
}
?>

<?php
if(isset($_GET['delid'])) { ?>
    <div class="popup popup--icon -question js_question-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">Sure</h3>
            <p>Are You Sure To Delete This Record?</p>
            <p>
                <a href="view-wards.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
                <a href="view-wards.php" class="button button--error" data-for="js_success-popup">No</a>
            </p>
        </div>
    </div>
<?php } ?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Wards</h4>
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
                                    <li class="breadcrumb-item"><a href="#">Wards</a></li>
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
                                            <th>Ward Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <?php if(isset($_SESSION['adminid'])) { ?>
                                                <th>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM wards WHERE delete_status='0'";
                                        $qsql = mysqli_query($conn, $sql);
                                        while($rs = mysqli_fetch_array($qsql)) {
                                            echo "<tr>
                                                  <td>{$rs['wardname']}</td>
                                                  <td>{$rs['description']}</td>
                                                  <td>{$rs['status']}</td>";
                                            if(isset($_SESSION['adminid'])) {
                                                echo "<td>
                                                      <a href='manage_wards.php?editid={$rs['wardid']}' class='btn btn-primary'>Edit</a> | 
                                                      <a href='view-wards.php?delid={$rs['wardid']}' class='btn btn-danger'>Delete</a>
                                                      </td>";
                                            }
                                            echo "</tr>";
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Ward Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <?php if(isset($_SESSION['adminid'])) { ?>
                                                <td><strong>Action</strong></td>
                                            <?php } ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="#"></div>
    </div>
</div>
<?php include('footer.php'); ?>

<?php if(!empty($_SESSION['success'])) { ?>
    <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">Success</h3>
            <p><?php echo $_SESSION['success']; ?></p>
            <p>
                <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
            </p>
        </div>
    </div>
<?php unset($_SESSION["success"]); } ?>

<?php if(!empty($_SESSION['error'])) { ?>
    <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">Error</h3>
            <p><?php echo $_SESSION['error']; ?></p>
            <p>
                <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
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
