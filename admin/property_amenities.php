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
    <title>Admin Panel | Add Amenities </title>
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
            border: 1px solid black;
        }

        .lbl {
            font-size: 30px;
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
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manage Property Amenities</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="web_script.php" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="username">Property Type</label>
                                                <select name='type' id="type" class="form-control" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="Luxury Villas">Luxury Villas</option>
                                                    <option value="Luxury Apartments">Luxury Apartments</option>
                                                    <option value="Luxury Penthouse">Luxury Penthouse</option>
                                                    <option value="Independant Floors">Independant Floors</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Property Name</label>
                                                <select name="name" id="name" class="form-control" required>
                                                    <option value=""> -- Select Property Type First -- </option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="MasterTemplate" id="master"> <label for="master" class="lbl" style="font-size: 16px;">Master Template</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="FacingClubhouse" id="facing"> <label for="facing" class="lbl" style="font-size: 16px;">Facing Clubhouse</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="AllWeatherPool" id="all"> <label for="all" style="font-size: 16px;">All Weather Pool</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="LavishInteriors" id="lavish"> <label for="lavish" style="font-size: 16px;">Lavish Interiors</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="ServantRoom" id="servant"> <label for="servant" style="font-size: 16px;">Servant Room</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="Clubhouse" id="club"> <label for="club" style="font-size: 16px;">Clubhouse</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="Gymnasium" id="gym"> <label for="gym" style="font-size: 16px;">Gymnasium</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="Garden" id="gar"> <label for="gar" style="font-size: 16px;">Garden</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="PrivateCinema" id="pc"> <label for="pc" style="font-size: 16px;">Private Cinema</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" class="checkboxall" name="YogaRoom" id="yr"> <label for="yr" style="font-size: 16px;">Yoga Room</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="PlotSizes" id="ps"> <label for="ps" style="font-size: 16px;">Plot Sizes</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="BanquetHall" id="bh"> <label for="bh" style="font-size: 16px;">Banquet Hall</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="Restaurant" id="rs"> <label for="rs" style="font-size: 16px;">Restaurant</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="SquashCourt" id="sc"> <label for="sc" style="font-size: 16px;">Squash Court</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="PoolTable" id="pt"> <label for="pt" style="font-size: 16px;">Pool Table</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="Bar" id="bar"> <label for="bar" style="font-size: 16px;">Bar</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="KidsPlay" id="kp"> <label for="kp" style="font-size: 16px;">Kids Play</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="Badminton" id="bm"> <label for="bm" style="font-size: 16px;">Badminton</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="CentralGarden" id="cg"> <label for="cg" style="font-size: 16px;">Central Garden</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="units" id="nou"> <label for="nou" style="font-size: 16px;">No. Of Units</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="CricketPitch" id="cp"> <label for="cp" style="font-size: 16px;">Cricket Pitch</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="BasketballGround" id="bg"> <label for="bg" style="font-size: 16px;">Basketball Ground</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="BowlingAle" id="ba"> <label for="ba" style="font-size: 16px;">Bowling Ale</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="CigarRoom" id="cr"> <label for="cr" style="font-size: 16px;">Cigar Room</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="ConferenceRoom" id="cr1"> <label for="cr1" style="font-size: 16px;">Conference Room</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="HomeTheatre" id="ht"> <label for="ht" style="font-size: 16px;">Home Theatre</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" class="checkboxall" name="CoffeeLongue" id="cl"> <label for="cl" style="font-size: 16px;">Coffee Longue</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" class="checkboxall" name="Library" id="lb"> <label for="lb" style="font-size: 16px;">Library</label>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <input type="checkbox" class="checkboxall" name="jacuzzi" id="jz"> <label for="jz" style="font-size: 16px;">Jacuzzi</label>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <input type="checkbox" id="selectall">
                                                <label for="selectall" style="font-size: 16px;color:#59bf70;">Select All</label>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#selectall").click(function() {
                                                        if (this.checked) {
                                                            $('.checkboxall').each(function() {
                                                                $(".checkboxall").prop('checked', true);
                                                            })
                                                        } else {
                                                            $('.checkboxall').each(function() {
                                                                $(".checkboxall").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>

                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="add_amenities" class="btn btn-primary btn-lg">Add </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Property Amenities</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>S.No</th>
                                                <th>Propery Type</th>
                                                <th>Property Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $q = "SELECT id , property_type , property_name FROM amenities";
                                            $sql = mysqli_query($con, $q);
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $w1 = $data['id'];
                                            ?>

                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $data['property_type']; ?></td>
                                                    <td><?php echo $data['property_name']; ?></td>
                                                    <td>
                                                        <div class="justify-content-between">
                                                          <!--  <a href="edit_property_amenities.php?amenities=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-edit btn btn-outline-primary" class=""></i></a>-->
                                                            <a href="remove.php?amenities=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-trash btn btn-outline-danger" class=""></i></a>
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