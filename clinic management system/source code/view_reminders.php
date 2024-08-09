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
                                    <h4>View Reminders</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a>View Reminders</a></li>
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
                                            <th>Reminder ID</th>
                                            <th>Patient Name</th>
                                            <th>Last Visit Date</th>
                                            <th>Next Visit Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT r.*, 
                                                   pat.patientname
                                            FROM reminders r
                                            JOIN patient pat ON r.patientid = pat.patientid";

                                        $qsql = mysqli_query($conn, $sql);
                                        while ($rs = mysqli_fetch_array($qsql)) {
                                            echo "<tr>
                                                    <td>{$rs['reminder_id']}</td>
                                                    <td>{$rs['patientname']}</td>
                                                    <td>{$rs['last_date']}</td>
                                                    <td>{$rs['next_date']}</td>
                                                    <td>{$rs['status']}</td>
                                                    <td>
                                                        <a href='edit_reminder.php?id={$rs['reminder_id']}' class='btn btn-primary'>Edit</a>
                                                    </td>
                                                  </tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Reminder ID</th>
                                            <th>Patient Name</th>
                                            <th>Last Visit Date</th>
                                            <th>Next Visit Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
