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
    <title>Admin Panel | Add Time Slot </title>
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

            $('#date').on('change', function() {
                var deptID = $(this).val();
                if (deptID) {
                    $.ajax({
                        type: 'POST',
                        url: 'slots.php',
                        data: 'd_id=' + deptID,
                        success: function(html) {
                            $('#slot').html(html);
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select Date first</option>');
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
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Visiting Hours</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="web_script.php" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Property Name</label>
                                                <select name="name" id="name" class="form-control" required>
                                                    <option value="">-- Select --</option>
                                                    <?php
                                                    $s0 = "SELECT name from properties";
                                                    $res0 = mysqli_query($con,$s0);
                                                    while ($data0 = mysqli_fetch_array($res0)) {
                                                    ?>
                                                        <option value="<?php echo $data0['name']; ?>"><?php echo $data0['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Date</label>
                                                <input type="date" name="date" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Time Slots</label>
                                                <select name="time" class="form-control" readonly>
                                                    <option value="">-- Select Time Slots --</option>
                                                    <option value="9 AM - 11 AM">9 AM - 11 AM</option>
                                                    <option value="11 AM - 1 PM">11 AM - 1 PM</option>
                                                    <option value="1 PM - 3 PM">1 PM - 3 PM</option>
                                                    <option value="3 PM - 5 PM">3 PM - 5 PM</option>
                                                    <option value="5 PM - 7 PM">5 PM - 7 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="add_slot" class="btn btn-primary btn-lg">Add </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Book Time Slot</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="web_script.php" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Property Name</label>
                                                <select name="name" id="name" class="form-control" required>
                                                    <option value="">-- Select --</option>
                                                    <?php
                                                    $s0 = "SELECT name from properties";
                                                    $res0 = mysqli_query($con,$s0);
                                                    while ($data0 = mysqli_fetch_array($res0)) {
                                                    ?>
                                                        <option value="<?php echo $data0['name']; ?>"><?php echo $data0['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Date</label>
                                                <input type="date" name="date" id="date" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Available Time Slots</label>
                                                <select name="time" id="slot" class="form-control" readonly>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="book_slot" class="btn btn-primary btn-lg">Book </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Timeslots</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Slot</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $q = "SELECT * FROM timeslot ORDER BY id DESC";
                                            $sql = mysqli_query($con, $q);
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $w1 = $data['id'];
                                            ?>

                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $data['name']; ?></td>
                                                    <td><?php echo $data['date']; ?></td>
                                                    <td><?php echo $data['slot']; ?></td>
                                                    
                                                    <td>
                                                        <div class="justify-content-between">
                                                            <a href="remove.php?slot=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-trash btn btn-outline-danger" class=""></i></a>
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