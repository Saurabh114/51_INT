<?php
require 'connection.php';
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
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
    <title>Admin Panel | View Properties </title>
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
                <div class="row" style="margin-top:-40px;">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Properties</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id='filter_data' method="post"  action="">
                                        <?php
                                       
                                       
                                        
                                        ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="username">City</label>
                                                <select name='city' id="type" class="form-control">
                                                    <option value="All">All</option>
                                                    <?php
                                                    //  $selected_city="selected=false";
                                        
                                                    $s0 = "SELECT city FROM properties";
                                                    $res0 = mysqli_query($con, $s0);
                                                    while ($data0 = mysqli_fetch_array($res0)) {
                                                        // if($city==$data0['city']){
                                                        //   $selected_city="selected=true"; 
                                                        // }
                                                    ?>
                                                        <option value="<?php echo $data0['city']; ?>"  ><?php echo $data0['city']; ?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Property Name</label>
                                                <select name="property" id="name" class="form-control">
                                                    <option value="All"> All </option>
                                                    <?php
                                                    //  $selected_property="selected=false";
                                                    $s = "SELECT name from properties";
                                                    $res = mysqli_query($con, $s);
                                                    while ($data = mysqli_fetch_array($res)) {
                                                        //  if($property==$data['name']){
                                                        //   $selected_property="selected=true"; 
                                                        // }
                                                    ?>
                                                        <option value="<?php echo $data['name']; ?>" ><?php echo $data['name']; ?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button type="submit" name="show" class="btn btn-primary btn-lg">Show</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                


                <div class="container" style="
    padding-right: 0px;
    padding-left: 0px;
">
                    <div class="row py-2">
                        <?php
                         $q = "SELECT * FROM properties";
                if(isset($_POST['show']))
                { 
                    $city =$_POST['city'];
                    $property=$_POST['property'];
                    $conditions =array();
                    
                    if($city!='All'){
                        $conditions[] = "city='$city'";
                    }
                    if($property!='All'){
                        $conditions[] = "name='$property'";
                    }
                    
                    if(count($conditions)>0){
                        $q .= " WHERE " . implode(' AND ',$conditions);
                    }
                    
                }
                        $res1 = mysqli_query($con, $q);
                        while ($data1 = mysqli_fetch_array($res1)) {
                        ?>
                            <div class=" col-md-6 col-lg-6 col-xl-6">
                                <div class="card text-black">
                                    <img src="Uploads/Property Images/<?php echo $data1['image']; ?>" class="card-img-top" alt="Image" style="height:300px;width:100%;" />
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="card-title"><?php echo $data1['name']; ?></h5>
                                            <p class="text-muted mb-4">
                                                <?php echo substr($data1['description'], 0, 40) ?>...
                                            </p>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <span>Size</span><span><?php echo $data1['size']; ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Property Area</span><span><?php echo $data1['property_area']; ?></span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                            <span>Price</span><span><?php echo $data1['price']; ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mt-4">
                                            <a class="btn btn-warning" href="seo.php?property=<?php echo $data1['id']; ?>"> SEO <i class="fa-solid fa-edit"></i></a>
                                            <a class="btn btn-info" href="view_property.php?property=<?php echo $data1['name']; ?>"> VIEW <i class="fa-solid fa-eye"></i></a>
                                            <a class="btn btn-danger" href="remove.php?property=<?php echo $data1['id']; ?>"> DELETE <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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