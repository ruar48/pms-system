<?php 
if(!(isset($_SESSION['user_id']))) {
  header("location:index.php");
  exit;
}
?>
<aside class="main-sidebar sidebar-dark-primary bg-black elevation-4">
    <a href="#" class="brand-link logo-switch bg-black">
        <h4 class="brand-image-xl logo-xs mb-0 text-center"><b></b></h4>
        <h4 class="brand-image-xl logo-xl mb-0 text-center">CDGCare</h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/logo.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['display_name'];?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item" id="mnu_dashboard">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item" id="mnu_patients">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>
                            <i class="fas "></i>
                            Patients
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="patients.php" class="nav-link" id="mi_patients">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Patients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="patient_history.php" class="nav-link" id="mi_patient_history">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Patient History</p>
                            </a>
                        </li>

                    </ul>
                </li>








                <li class="nav-item">
                    <a href="#!" class="nav-link" id="logout">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">


            <!-- Add your modal content here -->
            <h4 class="text-center mt-2">Are you sure you want to logout?</h4>

            <div class="text-center mt-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="logout.php" class="btn btn-primary">Logout</a>
                <br><br>
            </div>

        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#logout').click(function() {
        $('#exampleModal').modal('show');

    });
    $('#exampleModal .btn-secondary').click(function() {
        $('#exampleModal').modal('hide');
    });
});
</script>