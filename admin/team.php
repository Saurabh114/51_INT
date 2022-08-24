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
                                    <form action="web_script.php" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="username">Name</label>
                                                <input type="text" name='name' class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Image</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                                        <label class="custom-file-label" for="inputGroupFile01"</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="post">Post</label>
                                                <input type="text" name='post' class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="field">Field</label>
                                                <input type="text" name='field' class="form-control" required>
                                            </div>
                                                                                        <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name='email' class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="contact">Contact No. </label>
                                                <input type="text" name='contact' class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea rows="4" name="description" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="add_team" class="btn btn-primary btn-lg">Add </button>
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
                                <h4>Our Team</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Post</th>
                                                <th>Field</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $q = "SELECT * FROM our_team";
                                            $sql = mysqli_query($con, $q);
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $w1 = $data['id'];
                                            ?>

                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $data['name']; ?></td>
                                                    <td><img src="Uploads/Team Images/<?php echo $data['image']; ?>" style="height: 60px;width:60px;">
                                                    </td>
                                                    <td><?php echo $data['post']; ?></td>
                                                    <td><?php echo $data['field']; ?></td>
                                                    <td><?php echo $data['mobile_no']; ?></td>
                                                    <td><?php echo $data['email']; ?></td>
                                                    <td><?php echo $data['description']; ?></td>
                                                    <td>
                                                        <div class="justify-content-between">
                                                            <a href="edit_team.php?team=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-edit btn btn-outline-primary" class=""></i></a>
                                                            <a href="remove.php?team=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-trash btn btn-outline-danger" class=""></i></a>
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
    
    </div>
    </div>
    <?php include('includes/footer.php') ?>

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