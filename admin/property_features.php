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
    <title>Admin Panel | Add Property </title>
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
        .card {
            box-shadow: rgba(138, 136, 124, 0.35) 0px 5px 15px;
            border: 1px solid black;
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
                                <h4 class="card-title">Add Property Features</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="web_script.php" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="username">Type</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="Luxury Villas">Luxury Villas</option>
                                                    <option value="Luxury Apartments">Luxury Apartments</option>
                                                    <option value="Luxury Penthouse">Luxury Penthouse</option>
                                                    <option value="Independant Floors">Independant Floors</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="username">Property Name</label>
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Description </label>
                                                <textarea name='description' id="description" class="form-control" maxlength="200" required></textarea>
                                                <span id="current_desc" style="color: #59bf70;">0</span>
                                                <span id="" style="color: #59bf70;">/ 200</span>
                                            </div>
                                            <script type="text/javascript">
                                                var desc = document.getElementById("description");
                                                var current_desc = document.getElementById("current_desc");

                                                desc.addEventListener("keyup", function() {
                                                    var characters = desc.value.split('');
                                                    current_desc.innerHTML = characters.length;
                                                });
                                            </script>
                                            <div class="form-group col-md-6">
                                                <label>Add Property Banner Image for Background</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="add_property" class="btn btn-primary btn-lg">Add </button>
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
                                <h4>Blogs</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>S.No</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $q = "SELECT id ,type , image , name , description FROM properties";
                                            $sql = mysqli_query($con, $q);
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $w1 = $data['id'];
                                            ?>
                                                <tr class="text-center">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $data['type']; ?></td>
                                                    <td><?php echo $data['name']; ?></td>
                                                    <td><?php echo $data['description']; ?></td>
                                                    <td><img src="uploads/Property Images/<?php echo $data['image']; ?>" style="height: 60px;width:60px;">
                                                    </td>
                                                    <td>
                                                        <div class="justify-content-between">
                                                            <a href="edit_property_add.php?property=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-edit btn btn-outline-primary" class=""></i></a>
                                                            <a href="remove.php?property=<?php echo $w1; ?>" style="height: 30px;width:40px;"><i class="fas fa-trash btn btn-outline-danger" class=""></i></a>
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