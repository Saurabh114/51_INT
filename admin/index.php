<?php
require 'connection.php';
if (!isset($_SESSION['admin_id'])) {
  header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Panel | Dashboard </title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
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
    <section class="section">
      <div class="row">
        <div class="col-12">
          <a class="weatherwidget-io" href="https://forecast7.com/en/28d6677d23/delhi/" data-label_1="DELHI" data-label_2="WEATHER" data-icons="Climacons Animated" data-days="5" data-theme="weather_one">DELHI WEATHER</a>
        </div>
      </div>
      <div class="row " style="margin-top:40px;">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Properties </h5>
                      <?php
                      $q = "SELECT * FROM properties";
                      $row = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/p.png" alt="" style="height: 120px;width:120px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15"> Sell With Us</h5>
                      <?php
                      $q = "SELECT * FROM sell_with_us";
                      $row2 = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row2; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/s.png" alt="" style="height: 120px;width:120px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Testimonials</h5>
                      <?php
                      $q = "SELECT * FROM testimonials";
                      $row3 = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row3; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/t.png" alt="" style="height: 120px;width:120px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Blogs</h5>
                      <?php
                      $q = "SELECT * FROM blog";
                      $row4 = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row4; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/b.png" alt="" style="height: 120px;width:120px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Mumbai </h5>
                      <?php
                      $q = "SELECT * FROM properties WHERE city LIKE 'mumbai' OR city LIKE 'Mumbai'";
                      $row5 = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row5; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/m.png" alt="" style="height: 120px;width:120px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15"> New Delhi</h5>
                      <?php
                      $q = "SELECT * FROM properties WHERE city LIKE 'new delhi' OR city LIKE 'New delhi' OR city LIKE 'New Delhi' OR city LIKE 'new Delhi'";
                      $row6 = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row6; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/d.png" alt="" style="height: 120px;width:120px;" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                    <div class="card-content">
                      <h5 class="font-15">Gurugram</h5>
                      <?php
                      $q = "SELECT * FROM properties WHERE city LIKE 'gurugram' OR city LIKE 'Gurugram'";
                      $row7 = mysqli_num_rows(mysqli_query($con, $q));
                      ?>
                      <h2 class="mb-3 font-18"><?php echo $row7; ?></h2>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <div class="banner-img">
                      <img src="assets/img/banner/g.webp" alt="" style="height: 120px;width:120px;"    >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'includes/footer.php' ?>
  </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/weather.js"></script>

</body>

</html>