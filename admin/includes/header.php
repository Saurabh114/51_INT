<?php
$adm_id = $_SESSION['admin_id'];
$q = "SELECT * FROM admin WHERE id='$adm_id'";
$data = mysqli_fetch_array(mysqli_query($con, $q));
?>

<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn">
                            <i data-feather="align-justify"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
            <div style="
    margin-top: 15px;
    font-weight: bolder;
    font-size: 15px;
                shadow: rgba(138, 136, 124, 0.35) 0px 5px 15px;">
    <?php
        date_default_timezone_set("Asia/Kolkata");  
        $h = date('G');

        if($h>=5 && $h<=11)
        {
            echo "Good Morning !!";
        }
        else if($h>=12 && $h<=15)
        {
            echo "Good Afternoon !!";
        }
        else
        {
            echo "Good Evening !!";
        }
    ?>  </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="Uploads/Admin Images/<?php echo $data['image']; ?>" class="user-img-radious-style">
                        <span class="d-sm-none d-lg-inline-block"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">Hello , <?php echo $data['name']; ?> ! </div>
                        <a href="add_admin.php" class="dropdown-item has-icon">
                            <i class="fas fa-user-plus"></i>
                            Add Admin
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.php"> <img alt="image" src="assets/img/51_hh_logo.png" class="header-logo" style="height: 60px;"> 
                    </a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header"></li>
                    <li class="dropdown">
                        <a href="index.php" class="nav-link">
                            <i class="fas fa-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown">
                            <i class="fas fa-city"></i>
                            <span>Property</span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="nav-link" href="show_property.php">All Properties</a></li>    
                        <li><a class="nav-link" href="property_add.php">Add Property</a></li>
                        <li><a class="nav-link" href="gallery.php">Property Gallery</a></li>
                        <li><a class="nav-link" href="time_slots.php">Manage Time Slots</a></li>
                        <li><a class="nav-link" href="seo.php">Manage SEO</a></li>
                        <li><a class="nav-link" href="faq.php">FAQ</a></li>
                            <!--<li><a class="nav-link" href="property_amenities.php">Add Amenities</a></li>
                            <li><a class="nav-link" href="gallery.php">Add Gallery Images</a></li>
                            <li><a class="nav-link" href="video.php">Add Video </a></li>
                            <li><a class="nav-link" href="floorplan.php">Add Floorplan </a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown">
                        <i class="fas fa-hand-pointer"></i>
                            <span>Enquiries</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="sell_with_us.php">Property Listing Enquiries </a></li>
                            <li><a class="nav-link" href="contact_us.php">Contact Enquiries </a></li>
                            <li><a class="nav-link" href="enquiry_visits.php">Visits Scheduled </a></li>
                            <li><a class="nav-link" href="bro_flo_dow.php">Downloads (B/F) </a></li>
                            <!--<li><a class="nav-link" href="property_amenities.php">Add Amenities</a></li>
                            <li><a class="nav-link" href="time_slots.php">Manage Time Slots</a></li>
                            <li><a class="nav-link" href="gallery.php">Add Gallery Images</a></li>
                            <li><a class="nav-link" href="video.php">Add Video </a></li>
                            <li><a class="nav-link" href="floorplan.php">Add Floorplan </a></li>-->
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="slides.php" class="nav-link">
                            <i class="fas fa-image"></i>
                            <span>Slider</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="testimonials.php" class="nav-link">
                            <i class="fas fa-comments"></i>
                            <span>Testimonials</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="blog.php" class="nav-link">
                            <i class="fas fa-blog"></i>
                            <span>Add Blog </span></a>
                    </li>
                                        <li class="dropdown">
                        <a href="client.php" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Add Client </span></a>
                    </li>
                    <li class="dropdown">
                        <a href="team.php" class="nav-link">
                        <i class="fas fa-people-group"></i>
                            <span>Our Team </span></a>
                    </li>
                                        <li class="dropdown">
                        <a href="https://dashboard.collect.chat/62c31d4f7fd5da5e20c6b4eb/results/response" target="_blank" class="nav-link">
                        <i class="fas fa-comments"></i>
                            <span>ChatBot </span></a>
                    </li>
                </ul>
            </aside>
        </div>