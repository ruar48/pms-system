<?php
include './config/connection.php';
include './common_service/common_functions.php';


try {

// $query = "SELECT `id`, `patient_name`, `address`, 
// `course`, date_format(`date_of_birth`, '%d %b %Y') as `date_of_birth`, 
// `phone_number`, `gender` 
// FROM `patients` order by `patient_name` asc;";
  $query =  "SELECT * FROM `patients` ORDER BY CASE WHEN `id` = 1 THEN 0 ELSE 1 END, `id` ASC";

  $stmtPatient1 = $con->prepare($query);
  $stmtPatient1->execute();

} catch(PDOException $ex) {
  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './config/site_css_links.php';?>

    <?php include './config/data_tables_css.php';?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <title>Patients - Clinic's Patient Management System in PHP</title>

</head>

<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include './config/header.php';
include './config/sidebar.php';?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Patients Record</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>





            <section class="content">
                <!-- Default box -->
                <div class="card card-outline card-primary rounded-0 shadow">
                    <div class="card-header">
                        <h3 class="card-title">Total Patients</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row table-responsive">
                            <table id="all_patients" class="table table-striped dataTable table-bordered dtr-inline"
                                role="grid" aria-describedby="all_patients_info">
                                <colgroup>
                                    <colgroup>
                                        <col width="2%">
                                        <col width="15%">
                                        <col width="8%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="5%">
                                        <col width="10%">
                                        <col width="5%">
                                        <col width="10%">
                                        <col width="10%">


                                    </colgroup>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="p-1 text-center">S.No</th>
                                        <th class="p-1 text-center">Patient Name</th>
                                        <th class="p-1 text-center">Address</th>
                                        <th class="p-1 text-center">Course</th>
                                        <th class="p-1 text-center">Date Of Birth</th>
                                        <th class="p-1 text-center">Phone Number</th>
                                        <th class="p-1 text-center">Gender</th>
                                        <th class="p-1 text-center">Visit Date</th>
                                        <th class="p-1 text-center">Disease</th>
                                        <th class="p-1 text-center">Medicine</th>
                                        <th class="p-1 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                  $count = 0;
                  while($row =$stmtPatient1->fetch(PDO::FETCH_ASSOC)){
                    $count++;
                  ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['patient_name'];?></td>
                                        <td><?php echo $row['address'];?></td>
                                        <td><?php echo $row['course'];?></td>
                                        <td><?php echo $row['date_of_birth'];?></td>
                                        <td><?php echo $row['phone_number'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td><?php echo $row['visit'];?></td>
                                        <td><?php echo $row['disease'];?></td>
                                        <td><?php echo $row['medicine'];?></td>

                                        <td>
                                            <a href="update_patient.php?id=<?php echo $row['id'];?>"
                                                class="btn btn-primary btn-sm btn-flat">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#!" data-id="<?php echo $row['id'] ;?>"
                                                class="btn btn-danger btn-sm btn-flat btn-delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    <?php
                }
                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->


            </section>
        </div>
        <!-- delete modal -->
        <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="text-center"><br>
                        <h3>Are you sure want to delete this?</h3>
                    </div>
                    <div class="modal-body text-center ">
                        <i class="fa fa-trash" style="font-size: 50px; color:red;"></i>
                        <form id="delete-form">
                            <div id="msg"></div>
                            <input type="hidden" class="form-control" id="delete-id" name="id">

                            <div class="text-center mt-2">
                                <a href="#!" class="btn btn-secondary mr-2" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $('.btn-delete').click(function() {
                var id = $(this).data('id');
                $('#delete-id').val(id);
                $('#delete').modal('show');
            });

            // Close the modal when the "Close" button is clicked
            $('#delete .btn-secondary').click(function() {
                $('#delete').modal('hide');

            });

            $('#delete-form').submit(function(event) {
                event.preventDefault();
                var id = $('#delete-id').val();

                // Create FormData object to send data
                var formData = new FormData();
                formData.append('id', id);

                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    success: function(res) {
                        console.log('==================res===========');
                        console.log(res);
                        $('#msg').html(res);
                    },
                    error: function(res) {
                        console.error('Failed Delete:', res);
                        alert('Failed');
                    }
                });
            });
        });
        </script>
        <!-- end delete modal -->

        <!-- /.content -->

        <!-- /.content-wrapper -->
        <?php 
 include './config/footer.php';

  $message = '';
  if(isset($_GET['message'])) {
    $message = $_GET['message'];
  }
?>
        <!-- /.control-sidebar -->


        <?php include './config/site_js_links.php'; ?>
        <?php include './config/data_tables_js.php'; ?>


        <script src="plugins/moment/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete?")) {
                window.location.href = "patients.php?delete=" + $id;
            } else {

            }
        }
        </script>

        <script>
        showMenuSelected("#mnu_patients", "#mi_patient_history");

        var message = '<?php echo $message;?>';

        if (message !== '') {
            showCustomMessage(message);
        }
        $('#date_of_birth').datetimepicker({
            format: 'L'
        });


        $(function() {
            $("#all_patients").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');

        });
        </script>
</body>

</html>