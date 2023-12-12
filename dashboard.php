<?php 
include './config/connection.php';



$queryToday = "SELECT COUNT(*) as `today`
FROM patients
WHERE DATE(visit) = CURDATE()";

$queryAll = "SELECT count(*) as `all` 
from `patients`;";

$todaysCount = 0;
$allDataCount = 0;

try {
    $stmtToday = $con->prepare($queryToday);
    $stmtToday->execute();
    $r = $stmtToday->fetch(PDO::FETCH_ASSOC);
    $todaysCount = $r['today'];

    $stmtAll = $con->prepare($queryAll);
    $stmtAll->execute();
    $r = $stmtAll->fetch(PDO::FETCH_ASSOC);
    $allDataCount = $r['all'];

} catch(PDOException $ex) {
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <?php include './config/site_css_links.php';?>
    <title>Colegio De Getafe Clinic Management System</title>
    <style>
    .dark-mode .bg-fuchsia,
    .dark-mode .bg-maroon {
        color: #fff !important;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php 
    include './config/header.php';
    include './config/sidebar.php';
    ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $todaysCount;?></h3>
                                    <a href="patients.php">
                                        <p class="text-light">Today's Patients</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calendar-day"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-6 col-12">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3><?php echo $allDataCount;?></h3>
                                    <a href="patient_history.php">
                                        <p class="text-light">All Data</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include './config/footer.php';?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include './config/site_js_links.php';?>
    <script>
    $(function() {
        showMenuSelected("#mnu_dashboard", "");
    })
    </script>
</body>

</html>