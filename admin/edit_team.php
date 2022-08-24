<?php
require 'connection.php';
if (!isset($_SESSION['admin_id'])) {
    header('location:./login.php');
}
$team = $_GET['team'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Panel | Our Team </title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
    <style>
        .card 
        {
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
                                <h4 class="card-title">Add New Team Member</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <?php
                                    $q = "SELECT * FROM our_team WHERE id='$team'";
                                    $sql = mysqli_query($con, $q);
                                    while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                    <form action="web_script.php" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="username">Name</label>
                                                <input type="text" value="<?php echo $data['name']; ?>" name='name' class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                            <img src="Uploads/Team Images/<?php echo $data['image']; ?>" style="height: 120px;width:120px;margin-left: 30%;">
                                            </div>
                                            <div class="form-group col-md-6"></div>
                                            <div class="form-group col-md-6">
                                                <label>Image</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Post</label>
                                                <input type="text" name='post' value="<?php echo $data['post']; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Field</label>
                                                <input type="text" name='field' value="<?php echo $data['field']; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Description</label>
                                                <textarea name="description" class="form-control"><?php echo $data['description']; ?></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Contact No. </label>
                                                <input type="text" name='contact' value="<?php echo $data['mobile_no']; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Email</label>
                                                <input type="email" value="<?php echo $data['email']; ?>" name='email' class="form-control">
                                                <input type="hidden" name="id" value="<?php echo $team; ?>">
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="update_team" class="btn btn-primary btn-lg">Update </button>
                                                    <a href="team.php" class="btn btn-danger btn-lg" style="margin-left:20px;">Cancel</a>
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