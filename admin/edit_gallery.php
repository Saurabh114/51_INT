<?php
require 'connection.php';
if (!isset($_SESSION['admin_id'])) {
    header('location:./login.php');
}
$gallery = $_GET['gallery'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Panel | Add Gallery </title>
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
                                <h4 class="card-title">Add New Gallery Image</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    $q = "SELECT * FROM gallery WHERE id='$gallery'";
                                    $sql = mysqli_query($con, $q);
                                    while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                        <form action="web_script.php" method="post" enctype="multipart/form-data">

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="email">Property Name</label>
                                                    <select name="name" id="name" class="form-control" required>
                                                        <option value="<?php echo $data['name']; ?>"><?php echo $data['name']; ?></option>
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
                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_1']; ?>" style="height: 120px;width:120px;margin-left: 30%;">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" style="height: 120px;width:120px;margin-left: 30%;">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Replace This Image 1</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="image_1" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Replace This Image 2</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="image_2" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_3']; ?>" style="height: 120px;width:120px;margin-left: 30%;">
                                                </div>
                                                <div class="form-group col-md-6"></div>
                                                <div class="form-group col-md-6">
                                                    <label>Replace This Image 3</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="image_3" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            <input type="hidden" name="id" value="<?php echo $gallery; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                <label for="username">Image Type</label>
                                                <select name='img_type' class="form-control" required>
                                                    <option value="<?php echo $data['img_type']; ?>"><?php echo $data['img_type']; ?></option>
                                                    <option value="">-- Select --</option>
                                                    <option value="Interior">Interior</option>
                                                    <option value="Exterior">Exterior</option>
                                                    <option value="Amenities">Amenities</option>
                                                    <option value="Floorplan">Floorplan</option>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="container">
                                                <div class="text-center">
                                                    <div class="form-group">
                                                        <button type="submit" name="update_gallery" class="btn btn-primary btn-lg">Update </button>
                                                        <a href="gallery.php" class="btn btn-danger btn-lg" style="margin-left:20px;">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } ?>
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