<?php
require 'connection.php';
if (!isset($_SESSION['admin_id'])) {
    header('location:./login.php');
}
$name = $_GET['property'];

$q1 = "SELECT * FROM properties WHERE name='$name'";
$res1 = mysqli_query($con, $q1);
$data1 = mysqli_fetch_array($res1);

$q2 = "SELECT * FROM amenities WHERE property_name='$name'";
$res2 = mysqli_query($con, $q2);
$data2 = mysqli_fetch_array($res2);

$q3 = "SELECT * FROM floorplans WHERE name='$name' AND image_1 !=''";
$res3 = mysqli_query($con, $q3);
$data3 = mysqli_fetch_array($res3);

$q4 = "SELECT * FROM floorplans WHERE name='$name'";
$res4 = mysqli_query($con, $q4);
$data4 = mysqli_fetch_array($res4);

$q5 = "SELECT * FROM gallery WHERE name='$name'";
$res5 = mysqli_query($con, $q5);
$data5 = mysqli_fetch_array($res5);

$q6 = "SELECT * FROM timeslot WHERE name='$name'";
$res6 = mysqli_query($con, $q6);
$data6 = mysqli_fetch_array($res6);

$q7 = "SELECT * FROM video WHERE name='$name'";
$res7 = mysqli_query($con, $q7);
$data7 = mysqli_fetch_array($res7);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Panel | View Property </title>
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
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="d-flex justify-content-center form-group col-md-12">
                                        <img src="Uploads/Property Images/<?php echo $data1['image']; ?>" style="height: 120px;width:120px;border-radius: 5rem;">
                                    </div>
                                    <h4 class="d-flex justify-content-center">
                                        <?php echo $data1['name']; ?> , <?php echo $data1['city']; ?>
                                    </h4>
                                    <h5 class="d-flex justify-content-center">(<?php echo $data1['property_categories']; ?>)</h5>
                                    <p class="d-flex justify-content-center">
                                        <?php echo $data1['description']; ?>
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 col-md-8 col-lg-12">
                                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile1" aria-selected="true">Detail</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#profilea" role="tab" aria-controls="profilea" aria-selected="false">Amenities</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link " data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Video</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false">Floor Plan</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile4" aria-selected="false">Exterior</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile5" aria-selected="false">Interior</a>
                                                    </li>
                                                    <!--<li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#profile6" role="tab" aria-controls="profile6" aria-selected="false">Exterior</a>
                                                    </li>-->
                                                </ul>

                                                <div class="tab-content mt-3">
                                                    <div class="tab-pane active" id="profile1" role="tabpanel" aria-labelledby="profile1-tab">
                                                        <table class="table table-bordered">
                                                            <!--<thead>
                                                                    <tr>
                                                                        <th scope="col">First</th>
                                                                        <th scope="col">Handle</th>
                                                                    </tr>
                                                                </thead>-->
                                                            <tbody>
                                                                <tr>
                                                                    <td>Size</td>
                                                                    <td><?php echo $data1['size']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Price</td>
                                                                    <td><?php echo $data1['price']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Property Area</td>
                                                                    <td><?php echo $data1['property_area']; ?></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Brochure</td>
                                                                    <td><a href="Uploads/Docs/<?= $data1['brochure']; ?>" target="_blank"><?php echo $data1['brochure']; ?> </a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="profilea" role="tabpanel" aria-labelledby="profilea-tab">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <?php
                                                                    if($data2['master_template'] == "on"){
                                                                    ?>
                                                                    <td>Master Template</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['facing_clubhouse'] == "on"){
                                                                    ?>
                                                                    <td>Facing Clubhouse</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['all_weather_pool'] == "on"){
                                                                    ?>
                                                                    <td>All Weather Pool</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['lavish_interiors'] == "on"){
                                                                    ?>
                                                                    <td>Lavish Interiors</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['servant_room'] == "on"){
                                                                    ?>
                                                                    <td>Servant Room</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    if($data2['clubhouse'] == "on"){
                                                                    ?>
                                                                    <td>Clubhouse</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['gym'] == "on"){
                                                                    ?>
                                                                    <td>Gymnasium</td>
                                                                    <?php } ?>
                                                                    
                                                                     <?php
                                                                    if($data2['garden'] == "on"){
                                                                    ?>
                                                                    <td>Garden</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['private_cinema'] == "on"){
                                                                    ?>
                                                                    <td>Private Cinema</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['yoga_room'] == "on"){
                                                                    ?>
                                                                    <td>Yoga Room</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <?php
                                                                    if($data2['plot_sizes'] == "on"){
                                                                    ?>
                                                                    <td>Plot Sizes</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['banquet_hall'] == "on"){
                                                                    ?>
                                                                    <td>Banquet Hall</td>
                                                                    <?php } ?>
                                                                    
                                                                     <?php
                                                                    if($data2['garden'] == "on"){
                                                                    ?>
                                                                    <td>Garden</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['restaurant'] == "on"){
                                                                    ?>
                                                                    <td>Restaurant</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['squash_court'] == "on"){
                                                                    ?>
                                                                    <td>Squash Court</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <?php
                                                                    if($data2['pool_table'] == "on"){
                                                                    ?>
                                                                    <td>Pool Table</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['bar'] == "on"){
                                                                    ?>
                                                                    <td>Bar</td>
                                                                    <?php } ?>
                                                                    
                                                                     <?php
                                                                    if($data2['kids_play'] == "on"){
                                                                    ?>
                                                                    <td>Kids Play</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['badminton'] == "on"){
                                                                    ?>
                                                                    <td>Badminton Ground</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['central_garden'] == "on"){
                                                                    ?>
                                                                    <td>Central Garden</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <?php
                                                                    if($data2['units'] == "on"){
                                                                    ?>
                                                                    <td>Units</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['cricket_pitch'] == "on"){
                                                                    ?>
                                                                    <td>Cricket Pitch</td>
                                                                    <?php } ?>
                                                                    
                                                                     <?php
                                                                    if($data2['basketball'] == "on"){
                                                                    ?>
                                                                    <td>Basketball Ground</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['bowling_ale'] == "on"){
                                                                    ?>
                                                                    <td>Bowling Ale</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['cigar_room'] == "on"){
                                                                    ?>
                                                                    <td>Cigar Room</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <?php
                                                                    if($data2['conference_room'] == "on"){
                                                                    ?>
                                                                    <td>Conference Room</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['home_theatre'] == "on"){
                                                                    ?>
                                                                    <td>Home Theatre</td>
                                                                    <?php } ?>
                                                                    
                                                                     <?php
                                                                    if($data2['coffee_longue'] == "on"){
                                                                    ?>
                                                                    <td>Coffee Longue</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['library'] == "on"){
                                                                    ?>
                                                                    <td>Library</td>
                                                                    <?php } ?>
                                                                    
                                                                    <?php
                                                                    if($data2['jacuzzi'] == "on"){
                                                                    ?>
                                                                    <td>Jacuzzi</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="profile2" role="tabpanel" aria-labelledby="profile2-tab">
                                                        
                                                            <a href="<?php echo $data7['video']; ?>" target="_blank"> View Video</a>
                                                        
                                                    </div>
                                                    <div class="tab-pane" id="profile3" role="tabpanel" aria-labelledby="profile3-tab">
                                                        <?php 
                                                        if($data3['image_1'] == "")
                                                        {
                                                        ?>
                                                        <div class="container">
                                                            <h6> No Floorplan Images Added !</h6>
                                                        </div>
                                                        <?php } else{ ?> 
                                                        <div class="container">
                                                            <div class="row" style="padding-bottom: 40px;">
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail">
                                                                        <a href="Uploads/Floorplan Images/<?php echo $data3['image_1']; ?>" target="_blank">
                                                                            <img src="Uploads/Floorplan Images/<?php echo $data3['image_1']; ?>" alt="Lights" style="width:100%">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail">
                                                                        <a href="Uploads/Floorplan Images/<?php echo $data3['image_2']; ?>" target="_blank">
                                                                            <img src="Uploads/Floorplan Images/<?php echo $data3['image_2']; ?>" alt="Nature" style="width:100%">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail">
                                                                        <a href="Uploads/Floorplan Images/<?php echo $data3['image_3']; ?>" target="_blank">
                                                                            <img src="Uploads/Floorplan Images/<?php echo $data3['image_3']; ?>" alt="Nature" style="width:100%">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <?php 
                                                        if($data4['type1'] == ""){
                                                        ?>
                                                        <div class="container">
                                                            <h6> No Floorplan Details Added !</h6>
                                                        </div>
                                                        <?php } else { ?>
                                                        
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Size / Area</th>
                                                                    <th scope="col">Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <?php
                                                                    $i = 1;
                                                                    $q = "SELECT * FROM floorplans WHERE name='$name' AND size1 !=''";
                                                                    $res = mysqli_query($con, $q);
                                                                    while ($data = mysqli_fetch_array($res)) {
                                                                    ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i++; ?></th>
                                                                    <td><?php echo $data['type1']; ?></td>
                                                                    <td><?php echo $data['size1']; ?></td>
                                                                    <td><?php echo $data['prize1']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <?php
                                                                    $i = 2;
                                                                    $q = "SELECT * FROM floorplans WHERE name='$name' AND size2 !=''";
                                                                    $res = mysqli_query($con, $q);
                                                                    while ($data = mysqli_fetch_array($res)) {
                                                                    ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i++; ?></th>
                                                                    <td><?php echo $data['type2']; ?></td>
                                                                    <td><?php echo $data['size2']; ?></td>
                                                                    <td><?php echo $data['prize2']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <?php
                                                                    $i = 3;
                                                                    $q = "SELECT * FROM floorplans WHERE name='$name' AND size3 !=''";
                                                                    $res = mysqli_query($con, $q);
                                                                    while ($data = mysqli_fetch_array($res)) {
                                                                    ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i++; ?></th>
                                                                    <td><?php echo $data['type3']; ?></td>
                                                                    <td><?php echo $data['size3']; ?></td>
                                                                    <td><?php echo $data['prize3']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <?php
                                                                    $i = 4;
                                                                    $q = "SELECT * FROM floorplans WHERE name='$name' AND size4 !=''";
                                                                    $res = mysqli_query($con, $q);
                                                                    while ($data = mysqli_fetch_array($res)) {
                                                                    ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i++; ?></th>
                                                                    <td><?php echo $data['type4']; ?></td>
                                                                    <td><?php echo $data['size4']; ?></td>
                                                                    <td><?php echo $data['prize4']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <?php } ?>
                                                        
                                                    </div>
                                                    <div class="tab-pane" id="profile4" role="tabpanel" aria-labelledby="profile4">
                                                        <div class="container">
                                                            <div class="row">
                                                                <?php
                                                                $q = "SELECT * FROM gallery WHERE name='$name' AND img_type='Exterior'";
                                                                $res = mysqli_query($con, $q);
                                                                while ($data = mysqli_fetch_array($res)) {
                                                                ?>
                                                                    <?php
                                                                    if ($data['image_1'] != "") {
                                                                    ?>
                                                                        <div class="col-md-4" style="margin-top:20px;">
                                                                            <div class="thumbnail">
                                                                                <a href="Uploads/Gallery Images/<?php echo $data['image_1']; ?>" target="_blank">
                                                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_1']; ?>" alt="Lights" style="height:200px;width:100%">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if ($data['image_2'] != "") {
                                                                    ?>

                                                                        <div class="col-md-4" style="margin-top:20px;">
                                                                            <div class="thumbnail">
                                                                                <a href="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" target="_blank">
                                                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" alt="Nature" style="height:200px;width:100%">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if ($data['image_3'] != "") {
                                                                    ?>

                                                                        <div class="col-md-4" style="margin-top:20px;">
                                                                            <div class="thumbnail">
                                                                                <a href="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" target="_blank">
                                                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" alt="Nature" style="height:200px;width:100%">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                <?php }
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="profile5" role="tabpanel" aria-labelledby="profile5">
                                                        <div class="container">
                                                            <div class="row">
                                                                <?php
                                                                $q = "SELECT * FROM gallery WHERE name='$name' AND img_type='Interior'";
                                                                $res = mysqli_query($con, $q);
                                                                while ($data = mysqli_fetch_array($res)) {
                                                                ?>

                                                                    <?php
                                                                    if ($data['image_1'] != "") {
                                                                    ?>

                                                                        <div class="col-md-4" style="margin-top:20px;">
                                                                            <div class="thumbnail">
                                                                                <a href="Uploads/Gallery Images/<?php echo $data['image_1']; ?>" target="_blank">
                                                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_1']; ?>" alt="Lights" style="height:200px;width:100%">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if ($data['image_2'] != "") {
                                                                    ?>

                                                                        <div class="col-md-4" style="margin-top:20px;">
                                                                            <div class="thumbnail">
                                                                                <a href="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" target="_blank">
                                                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_2']; ?>" alt="Nature" style="height:200px;width:100%">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if ($data['image_3'] != "") {
                                                                    ?>

                                                                        <div class="col-md-4" style="margin-top:20px;">
                                                                            <div class="thumbnail">
                                                                                <a href="Uploads/Gallery Images/<?php echo $data['image_3']; ?>" target="_blank">
                                                                                    <img src="Uploads/Gallery Images/<?php echo $data['image_3']; ?>" alt="Nature" style="height:200px;width:100%">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                <?php }
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="tab-pane" id="profile6" role="tabpanel" aria-labelledby="profile6">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail">
                                                                        <a href="/w3images/lights.jpg" target="_blank">
                                                                            <img src="assets/img/4.jpg" alt="Lights" style="width:100%">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail">
                                                                        <a href="/w3images/nature.jpg" target="_blank">
                                                                            <img src="assets/img/4.jpg" alt="Nature" style="width:100%">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="thumbnail">
                                                                        <a href="/w3images/nature.jpg" target="_blank">
                                                                            <img src="assets/img/4.jpg" alt="Nature" style="width:100%">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
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