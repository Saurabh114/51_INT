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
    <title>Properties Listing Enquiries</title>
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
                                <h4>Properties Listing Enquiries</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Property Name</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $q = "SELECT id , name , property_name , location FROM sell_with_us";
                                            $sql = mysqli_query($con, $q);
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $w1 = $data['id'];
                                            ?>

                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $data['name']; ?></td>
                                                    <td><?php echo $data['property_name']; ?></td>
                                                    <td><?php echo $data['location']; ?></td>
                                                    <td>
                                                        <div class="justify-content-between">
                                                            <a href="" style="height: 30px;width:40px;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $w1; ?>"><i class="fas fa-eye btn btn-outline-primary" class=""></i></a>
                                                            <a href="remove.php?sell=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-trash btn btn-outline-danger" class=""></i></a>
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

    <!-- Modal -->
    <?php
    $q = "SELECT * FROM sell_with_us";
    $sql = mysqli_query($con, $q);
    while ($data = mysqli_fetch_array($sql)) {
        $w1 = $data['id'];
    ?>
        <div class="modal fade" id="exampleModalCenter<?php echo $w1; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $data['property_name']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $data['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $data['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td><?php echo $data['contact']; ?></td>
                                </tr>
                                <tr>
                                    <th>Property Location</th>
                                    <td><?php echo $data['location']; ?></td>
                                </tr>
                                <tr>
                                    <th>House No.</th>
                                    <td><?php echo $data['house_no']; ?></td>
                                </tr>
                                <tr>
                                    <th>Bedroom</th>
                                    <td><?php echo $data['bedroom']; ?></td>
                                </tr>
                                <tr>
                                    <th>Bathroom</th>
                                    <td><?php echo $data['bathroom']; ?></td>
                                </tr>
                                <tr>
                                    <th>Balcony</th>
                                    <td><?php echo $data['balcony']; ?></td>
                                </tr>
                                <tr>
                                    <th>Property Area</th>
                                    <td><?php echo $data['property_area']; ?></td>
                                </tr>
                                <tr>
                                    <th>Furnishing</th>
                                    <td><?php echo $data['furnishing']; ?></td>
                                </tr>
                                <tr>
                                    <th>Floor Details</th>
                                    <td><?php echo $data['floor_details']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo $data['status']; ?></td>
                                </tr>
                                <tr>
                                    <th>Property Age</th>
                                    <td><?php echo $data['property_age']; ?></td>
                                </tr>
                                <tr>
                                    <th>Card Thumbnail</th>
                                    <td><?php echo $data['card_thumbnail']; ?></td>
                                </tr>
                                <tr>
                                    <th>Video</th>
                                    <td><?php echo $data['video']; ?></td>
                                </tr>
                                <tr>
                                    <th>Layout</th>
                                    <td><?php echo $data['layout']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pricing</th>
                                    <td><?php echo $data['pricing_details']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


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