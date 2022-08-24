<?php 

include 'connection.php';

if(isset($_GET['blog'])) {

    $id= mysqli_real_escape_string($con, $_GET['blog']);
    $dq = "DELETE FROM blog WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:blog.php');
    }
}


if(isset($_GET['sell_with_us'])) {

    $id= mysqli_real_escape_string($con, $_GET['sell_with_us']);
    $dq = "DELETE FROM sell_with_us WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:sell_with_us.php');
    }
}

if(isset($_GET['admin'])) {

    $id= mysqli_real_escape_string($con, $_GET['admin']);
    $dq = "DELETE FROM admin WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:add_admin.php');
    }
}

if(isset($_GET['amenities'])) {

    $id= mysqli_real_escape_string($con, $_GET['amenities']);
    $dq = "DELETE FROM amenities WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:property_amenities.php');
    }
}

if(isset($_GET['property'])) {

    $id= mysqli_real_escape_string($con, $_GET['property']);
    
    $q = "SELECT * FROM properties WHERE id='$id'";
    $res = mysqli_query($con,$q);
    $data = mysqli_fetch_array($res);
    $nm = $data['name'];
    
    $q1 = "DELETE FROM amenities WHERE property_name='$nm'";
    $q2 = "DELETE FROM gallery WHERE name='$nm'";
    $q3 = "DELETE FROM video WHERE name='$nm'";
    $q4 = "DELETE FROM floorplans WHERE name='$nm'";
    $q5 = "DELETE FROM properties WHERE id LIKE '$id'";
    $q6 = "DELETE FROM timeslot WHERE name='$nm'";
    if(mysqli_query($con,$q1) && mysqli_query($con,$q2) && mysqli_query($con,$q3) && mysqli_query($con,$q4) && mysqli_query($con,$q5) && mysqli_query($con,$q6)) {
        header('location:show_property.php');
    }
}

if(isset($_GET['gallery'])) {

    $id= mysqli_real_escape_string($con, $_GET['gallery']);
    $dq = "DELETE FROM gallery WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:gallery.php');
    }
}

if(isset($_GET['video'])) {

    $id= mysqli_real_escape_string($con, $_GET['video']);
    $dq = "DELETE FROM video WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:video.php');
    }
}

if(isset($_GET['slide'])) {

    $id= mysqli_real_escape_string($con, $_GET['slide']);
    $dq = "DELETE FROM slides WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:slides.php');
    }
}

if(isset($_GET['testimonial'])) {

    $id= mysqli_real_escape_string($con, $_GET['testimonial']);
    $dq = "DELETE FROM testimonials WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:testimonials.php');
    }
}
if(isset($_GET['floorplan'])) {

    $id= mysqli_real_escape_string($con, $_GET['floorplan']);
    $dq = "DELETE FROM floorplans WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:floorplan.php');
    }
}

if(isset($_GET['team'])) {

    $id= mysqli_real_escape_string($con, $_GET['team']);
    $dq = "DELETE FROM our_team WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:team.php');
    }
}
if(isset($_GET['slot'])) {

    $id= mysqli_real_escape_string($con, $_GET['slot']);
    $dq = "DELETE FROM timeslot WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:time_slots.php');
    }
}

if(isset($_GET['slot_book'])) {

    $id= mysqli_real_escape_string($con, $_GET['slot_book']);
    $dq = "DELETE FROM visits WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:enquiry_visits.php');
    }
}

if(isset($_GET['faq'])) {

    $id= mysqli_real_escape_string($con, $_GET['faq']);
    $dq = "DELETE FROM faq WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:faq.php');
    }
}

if(isset($_GET['sell'])) {

    $id= mysqli_real_escape_string($con, $_GET['sell']);
    $dq = "DELETE FROM sell_with_us WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:sell_with_us.php');
    }
}

if(isset($_GET['contact'])) {

    $id= mysqli_real_escape_string($con, $_GET['contact']);
    $dq = "DELETE FROM contact_us WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:contact_us.php');
    }
}

if(isset($_GET['bro_flo'])) {

    $id= mysqli_real_escape_string($con, $_GET['bro_flo']);
    $dq = "DELETE FROM downloads WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:bro_flo_dow.php');
    }
}

if(isset($_GET['client'])) {

    $id= mysqli_real_escape_string($con, $_GET['client']);
    $dq = "DELETE FROM clients WHERE id LIKE '$id'";
    if(mysqli_query($con,$dq)) {
        header('location:client.php');
    }
}
?>