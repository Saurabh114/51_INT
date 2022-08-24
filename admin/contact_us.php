<?php
require 'connection.php';
if (!isset($_SESSION['admin_id'])) {
    header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Enquiries </title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
    <style>
        .card {
            box-shadow: rgba(138, 136, 124, 0.35) 0px 5px 15px;
            border: 1px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#type').on('change', function() {
                var deptID = $(this).val();
                if (deptID) {
                    $.ajax({
                        type: 'POST',
                        url: 'property_name.php',
                        data: 'p_id=' + deptID,
                        success: function(html) {
                            $('#name').html(html);
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select State first</option>');
                }
            });
        });
    </script>

</head>

<body>
    <?php include 'includes/header.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Enquiries</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $q = "SELECT * FROM contact_us";
                                            $sql = mysqli_query($con, $q);
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $w1 = $data['id'];
                                            ?>
                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $data['name']; ?></td>
                                                    <td><?php echo $data['email']; ?></td>
                                                    <td><?php echo $data['message']; ?></td>
                                                    <td>
                                                        <div class="justify-content-between">
                                                            <a href="remove.php?contact=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-trash btn btn-outline-danger" class=""></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php') ?>

    </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
</body>

</html>