<?php
include 'connection.php';

function compressImage($source_img, $compress_img)
{
    $img_info = getimagesize($source_img);
    if ($img_info['mime'] == 'image/jpeg') {
        $source_img =  imagecreatefromjpeg($source_img);
        imagejpeg($source_img, $compress_img, 20);
    } elseif ($img_info['mime'] == 'image/png') {
        $source_img =  imagecreatefrompng($source_img);
        imagepng($source_img, $compress_img, 5);
    }
    return $compress_img;
}

if (isset($_POST['add_admin'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['email']);
    $a3 = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $s = "SELECT * FROM admin WHERE email = '$a2'";
    $row = mysqli_num_rows(mysqli_query($con, $s));
    if ($row > 0) {
        echo "<script> alert('This email alreadt exist ! Please Enter another email.') </script>";
        echo "<script> window.location='./add_admin.php'</script>  ";
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Admin-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Admin Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);
            $compress_file = "compress_" . $new_img_name;
            $compressed_img = "Uploads/Admin Images/" . $new_img_name;
            $compress_name = compressImage($img_upload_path, $compressed_img);

            $q = "INSERT INTO admin(name,email,password,image) 
        VALUES('$a1','$a2','$a3','$new_img_name')";

            if ($con->query($q) === TRUE) {
                echo "<script> alert('New Admin Added !') </script>";
                echo "<script> window.location='./add_admin.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}

if (isset($_POST['add_blog'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['heading']);
    $a2 = mysqli_real_escape_string($con, $_POST['description']);
    $a3 = mysqli_real_escape_string($con, $_POST['category']);
    $a4 = mysqli_real_escape_string($con, $_POST['date']);
    $img = $_FILES['image']['name'];

    if (empty($img)) {
        $q3 = "INSERT INTO blog(heading,text,category,date) 
    VALUES('$a1','$a2','$a3','$a4')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Blog Added !') </script>";
            echo "<script> window.location='./blog.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Blog-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Blog Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);
            $compress_file = "compress_" . $new_img_name;
            $compressed_img = "Uploads/Blog Images/" . $new_img_name;
            $compress_name = compressImage($img_upload_path, $compressed_img);

            $q3 = "INSERT INTO blog(heading,text,image,category,date) VALUES('$a1','$a2','$new_img_name','$a3','$a4')";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('New Blog Added !') </script>";
                echo "<script> window.location='./blog.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}

if (isset($_POST['update_blog'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['heading']);
    $a2 = mysqli_real_escape_string($con, $_POST['description']);
    $a3 = mysqli_real_escape_string($con, $_POST['id']);
    $a4 = mysqli_real_escape_string($con, $_POST['category']);
    $a5 = mysqli_real_escape_string($con, $_POST['date']);
    $img = $_FILES['image']['name'];

    if (empty($img)) {
        $q3 = "UPDATE blog SET heading='$a1' , text='$a2' , category='$a4' , date='$a5' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./blog.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Blog-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Blog Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);
            $compress_file = "compress_" . $new_img_name;
            $compressed_img = "Uploads/Blog Images/" . $new_img_name;
            $compress_name = compressImage($img_upload_path, $compressed_img);

            $q3 = "UPDATE blog SET heading='$a1' , text='$a2' , image='$new_img_name' , category='$a4', date='$a5' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./blog.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}


if (isset($_POST['add_gallery'])) {
    $a2 = mysqli_real_escape_string($con, $_POST['name']);
    $a3 = mysqli_real_escape_string($con, $_POST['img_type']);

    //--------------------------------- Image 1 Start
    $img_name1 = $_FILES['image_1']['name'];
    $img_size1 = $_FILES['image_1']['size'];
    $img_tmpname1 = $_FILES['image_1']['tmp_name'];
    $error1 = $_FILES['image_1']['error'];
    //--------------------------------- Image 1 End

    //--------------------------------- Image 2 Start
    $img_name2 = $_FILES['image_2']['name'];
    $img_size2 = $_FILES['image_2']['size'];
    $img_tmpname2 = $_FILES['image_2']['tmp_name'];
    $error2 = $_FILES['image_2']['error'];
    //--------------------------------- Image 2 End

    //--------------------------------- Image 3 Start
    $img_name3 = $_FILES['image_3']['name'];
    $img_size3 = $_FILES['image_3']['size'];
    $img_tmpname3 = $_FILES['image_3']['tmp_name'];
    $error3 = $_FILES['image_3']['error'];
    //--------------------------------- Image 3 End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
    $img_ex3 = pathinfo($img_name3, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $img_ex_lc2 = strtolower($img_ex2);
    $img_ex_lc3 = strtolower($img_ex3);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc1, $allowed_ex) || in_array($img_ex_lc2, $allowed_ex) || in_array($img_ex_lc3, $allowed_ex)) {

        //--------------------------------- Image 1 Start
        $new_img_name1 = uniqid("Gallery_1-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/Gallery Images/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //$compress_file1 = "compress_" . $new_img_name1;
        //$compressed_img1 = "uploads/Gallery Images/" . $new_img_name1;
        //$compress_name1 = compressImage($img_upload_path1, $compressed_img1);
        //--------------------------------- Image 1 End

        //--------------------------------- Image 2 Start
        $new_img_name2 = uniqid("Gallery_2-", true) . '.' . $img_ex_lc2;
        $img_upload_path2 = 'Uploads/Gallery Images/' . $new_img_name2;
        move_uploaded_file($img_tmpname2, $img_upload_path2);
        //$compress_file2 = "compress_" . $new_img_name2;
        //$compressed_img2 = "uploads/Gallery Images/" . $new_img_name2;
        //$compress_name2 = compressImage($img_upload_path2, $compressed_img2);
        //--------------------------------- Image 2 End

        //--------------------------------- Image 3 Start
        $new_img_name3 = uniqid("Gallery_3-", true) . '.' . $img_ex_lc3;
        $img_upload_path3 = 'Uploads/Gallery Images/' . $new_img_name3;
        move_uploaded_file($img_tmpname3, $img_upload_path3);
        //$compress_file3 = "compress_" . $new_img_name3;
        //$compressed_img3 = "uploads/Gallery Images/" . $new_img_name3;
        //$compress_name3 = compressImage($img_upload_path3, $compressed_img3);
        //--------------------------------- Image 3 End

        $q3 = "INSERT INTO gallery(name,img_type,image_1,image_2,image_3) VALUES('$a2','$a3','$new_img_name1','$new_img_name2','$new_img_name3')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Gallery Image Added !') </script>";
            echo "<script> window.location='./gallery.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload images only in image format!') </script>";
    }
}

if (isset($_POST['update_gallery'])) {
    $a2 = mysqli_real_escape_string($con, $_POST['name']);
    $a3 = mysqli_real_escape_string($con, $_POST['id']);
    $a4 = mysqli_real_escape_string($con, $_POST['img_type']);
    $img1 = $_FILES['image_1']['name'];
    $img2 = $_FILES['image_2']['name'];
    $img3 = $_FILES['image_3']['name'];

    if (empty($img1)) {
        $q3 = "UPDATE gallery SET name='$a2' , img_type='$a4' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./gallery.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image_1']['name'];
        $img_size = $_FILES['image_1']['size'];
        $img_tmpname = $_FILES['image_1']['tmp_name'];
        $error = $_FILES['image_1']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Gallery_1-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Gallery Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);
            $compress_file = "compress_" . $new_img_name;
            $compressed_img = "Uploads/Gallery Images/" . $new_img_name;
            $compress_name = compressImage($img_upload_path, $compressed_img);

            $q3 = "UPDATE gallery SET name='$a2' , image_1='$new_img_name', img_type='$a4' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./gallery.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }

    if (empty($img2)) {
        $q3 = "UPDATE gallery SET category='$a1' , name='$a2', img_type='$a4' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./gallery.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image_2']['name'];
        $img_size = $_FILES['image_2']['size'];
        $img_tmpname = $_FILES['image_2']['tmp_name'];
        $error = $_FILES['image_2']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Gallery_2-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Gallery Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);
            $compress_file = "compress_" . $new_img_name;
            $compressed_img = "Uploads/Gallery Images/" . $new_img_name;
            $compress_name = compressImage($img_upload_path, $compressed_img);

            $q3 = "UPDATE gallery SET category='$a1' , name='$a2' , image_2='$new_img_name', img_type='$a4' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./gallery.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }

    if (empty($img2)) {
        $q3 = "UPDATE gallery SET category='$a1' , name='$a2', img_type='$a4' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./gallery.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image_3']['name'];
        $img_size = $_FILES['image_3']['size'];
        $img_tmpname = $_FILES['image_3']['tmp_name'];
        $error = $_FILES['image_3']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Gallery_3-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'uploads/Gallery Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);
            $compress_file = "compress_" . $new_img_name;
            $compressed_img = "Uploads/Gallery Images/" . $new_img_name;
            $compress_name = compressImage($img_upload_path, $compressed_img);

            $q3 = "UPDATE gallery SET category='$a1' , name='$a2' , image_3='$new_img_name' , img_type='$a4' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./gallery.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}

if (isset($_POST['property_name'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['type']);
    $a2 = mysqli_real_escape_string($con, $_POST['property_name']);
    $a3 = mysqli_real_escape_string($con, $_POST['description']);
    $a5 = mysqli_real_escape_string($con, $_POST['size']);
    $a6 = mysqli_real_escape_string($con, $_POST['price']);
    $a7 = mysqli_real_escape_string($con, $_POST['area']);
    $a8 = mysqli_real_escape_string($con, $_POST['location']);
    $a9 = mysqli_real_escape_string($con, $_POST['city']);
    
    //  Aminities
    
    $a10 = mysqli_real_escape_string($con, $_POST['MasterTemplate']);
    $a11 = mysqli_real_escape_string($con, $_POST['FacingClubhouse']);
    $a12 = mysqli_real_escape_string($con, $_POST['AllWeatherPool']);
    $a13 = mysqli_real_escape_string($con, $_POST['LavishInteriors']);
    $a14 = mysqli_real_escape_string($con, $_POST['ServantRoom']);
    $a15 = mysqli_real_escape_string($con, $_POST['Clubhouse']);
    $a16 = mysqli_real_escape_string($con, $_POST['Gymnasium']);
    $a17 = mysqli_real_escape_string($con, $_POST['Garden']);
    $a18 = mysqli_real_escape_string($con, $_POST['PrivateCinema']);
    $a19 = mysqli_real_escape_string($con, $_POST['YogaRoom']);
    $a20 = mysqli_real_escape_string($con, $_POST['PlotSizes']);
    $a21 = mysqli_real_escape_string($con, $_POST['BanquetHall']);
    $a22 = mysqli_real_escape_string($con, $_POST['Restaurant']);
    $a23 = mysqli_real_escape_string($con, $_POST['SquashCourt']);
    $a24 = mysqli_real_escape_string($con, $_POST['PoolTable']);
    $a25 = mysqli_real_escape_string($con, $_POST['Bar']);
    $a26 = mysqli_real_escape_string($con, $_POST['KidsPlay']);
    $a27 = mysqli_real_escape_string($con, $_POST['Badminton']);
    $a28 = mysqli_real_escape_string($con, $_POST['CentralGarden']);
    $a29 = mysqli_real_escape_string($con, $_POST['units']);
    $a30 = mysqli_real_escape_string($con, $_POST['CricketPitch']);
    $a31 = mysqli_real_escape_string($con, $_POST['BasketballGround']);
    $a32 = mysqli_real_escape_string($con, $_POST['BowlingAle']);
    $a33 = mysqli_real_escape_string($con, $_POST['CigarRoom']);
    $a34 = mysqli_real_escape_string($con, $_POST['ConferenceRoom']);
    $a35 = mysqli_real_escape_string($con, $_POST['HomeTheatre']);
    $a36 = mysqli_real_escape_string($con, $_POST['CoffeeLongue']);
    $a37 = mysqli_real_escape_string($con, $_POST['Library']);
    $a38 = mysqli_real_escape_string($con, $_POST['jacuzzi']);
    
    //floorplan table
    
    $a39 = mysqli_real_escape_string($con, $_POST['type1']);
    $a40 = mysqli_real_escape_string($con, $_POST['size1']);
    $a41 = mysqli_real_escape_string($con, $_POST['prize1']);
    
    $a42 = mysqli_real_escape_string($con, $_POST['type2']);
    $a43 = mysqli_real_escape_string($con, $_POST['size2']);
    $a44 = mysqli_real_escape_string($con, $_POST['prize2']);
    
    $a45 = mysqli_real_escape_string($con, $_POST['type3']);
    $a46 = mysqli_real_escape_string($con, $_POST['size3']);
    $a47 = mysqli_real_escape_string($con, $_POST['prize3']);
    
    $a48 = mysqli_real_escape_string($con, $_POST['type4']);
    $a49 = mysqli_real_escape_string($con, $_POST['size4']);
    $a50 = mysqli_real_escape_string($con, $_POST['prize4']);
    
    $a51 = mysqli_real_escape_string($con, $_POST['video']);

    //--------------------------------------- Image Start
    $img_name1 = $_FILES['image']['name'];
    $img_size1 = $_FILES['image']['size'];
    $img_tmpname1 = $_FILES['image']['tmp_name'];
    $error1 = $_FILES['image']['error'];
    //--------------------------------------- Image End

    //---------------------------------- Brochure Start
    $temp = explode(".", $_FILES["brochure"]["name"]);
    $extension = end($temp);
    //$upload_file = $_FILES["pdf"]["name"];
    $upload_file = uniqid("Brochure - ", true) . '.' . $extension;
    move_uploaded_file($_FILES["brochure"]["tmp_name"], "Uploads/Docs/" . $upload_file);
    //---------------------------------- Brochure End

    //----------------------------Cover Image Start
    $img_name2 = $_FILES['cover_image']['name'];
    $img_size2 = $_FILES['cover_image']['size'];
    $img_tmpname2 = $_FILES['cover_image']['tmp_name'];
    $error2 = $_FILES['cover_image']['error'];
    //----------------------------Cover Image End
    
    //--------------------------------- Floorplan Image 1 Start
    $img_name4 = $_FILES['fimage_1']['name'];
    $img_size4 = $_FILES['fimage_1']['size'];
    $img_tmpname4 = $_FILES['fimage_1']['tmp_name'];
    $error4 = $_FILES['fimage_1']['error'];
    //--------------------------------- Floorplan Image 1 End

    //--------------------------------- Floorplan Image 2 Start
    $img_name5 = $_FILES['fimage_2']['name'];
    $img_size5 = $_FILES['fimage_2']['size'];
    $img_tmpname5 = $_FILES['fimage_2']['tmp_name'];
    $error5 = $_FILES['fimage_2']['error'];
    //--------------------------------- Floorplan Image 2 End

    //--------------------------------- Floorplan Image 3 Start
    $img_name6 = $_FILES['fimage_3']['name'];
    $img_size6 = $_FILES['fimage_3']['size'];
    $img_tmpname6 = $_FILES['fimage_3']['tmp_name'];
    $error6 = $_FILES['fimage_3']['error'];
    //--------------------------------- Floorplan Image 3 End
    
    //---------------------------------- Floorplan Document Start
    $temp1 = explode(".", $_FILES["floorplan"]["name"]);
    $extension1 = end($temp1);
    //$upload_file = $_FILES["pdf"]["name"];
    $upload_file1 = uniqid("Floorplan - ", true) . '.' . $extension1;
    move_uploaded_file($_FILES["floorplan"]["tmp_name"], "Uploads/Floorplan Images/" . $upload_file1);
    //---------------------------------- Floorplan Document End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
    $img_ex4 = pathinfo($img_name4, PATHINFO_EXTENSION);
    $img_ex5 = pathinfo($img_name5, PATHINFO_EXTENSION);
    $img_ex6 = pathinfo($img_name6, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $img_ex_lc2 = strtolower($img_ex2);
    $img_ex_lc4 = strtolower($img_ex4);
    $img_ex_lc5 = strtolower($img_ex5);
    $img_ex_lc6 = strtolower($img_ex6);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");


    // if (in_array($img_ex_lc1, $allowed_ex) && in_array($img_ex_lc2, $allowed_ex)) {

        //--------------------------------- Image Start
        $new_img_name1 = uniqid("Property-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/Property Images/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //--------------------------------- Image End

        //--------------------------------- Cover Image Start
        $new_img_name2 = uniqid("Cover-", true) . '.' . $img_ex_lc2;
        $img_upload_path2 = 'Uploads/Videos/' . $new_img_name2;
        move_uploaded_file($img_tmpname2, $img_upload_path2);
        //--------------------------------- Cover Image End
        
        //--------------------------------- Floorplan Image 1 Start
        $new_img_name4 = uniqid("Floorplan_1-", true) . '.' . $img_ex_lc4;
        $img_upload_path4 = 'Uploads/Floorplan Images/' . $new_img_name4;
        move_uploaded_file($img_tmpname4, $img_upload_path4);
        //--------------------------------- Floorplan Image 1 End
        
        //--------------------------------- Floorplan Image 2 Start
        $new_img_name5 = uniqid("Floorplan_2-", true) . '.' . $img_ex_lc4;
        $img_upload_path5 = 'Uploads/Floorplan Images/' . $new_img_name5;
        move_uploaded_file($img_tmpname5, $img_upload_path5);
        //--------------------------------- Floorplan Image 2 End
        
        //--------------------------------- Floorplan Image 3 Start
        $new_img_name6 = uniqid("Floorplan_3-", true) . '.' . $img_ex_lc6;
        $img_upload_path6 = 'Uploads/Floorplan Images/' . $new_img_name6;
        move_uploaded_file($img_tmpname6, $img_upload_path6);
        //--------------------------------- Floorplan Image 3 End

        $q3 = "INSERT INTO properties(image,name,property_categories,description,map_link,city,size,price,property_area,brochure) 
        VALUES('$new_img_name1','$a2','$a1','$a3','$a8','$a9','$a5','$a6','$a7','$upload_file')";

        $q4 = "INSERT INTO video(category,name,image,video) VALUES('$a1','$a2','$new_img_name2','$a51')";

        $q5 = "INSERT INTO amenities(property_type,property_name,master_template,facing_clubhouse,all_weather_pool,
        lavish_interiors,servant_room,clubhouse,gym,garden,private_cinema,yoga_room,plot_sizes,banquet_hall,restaurant,squash_court,pool_table,bar,kids_play,badminton,central_garden,units,cricket_pitch,basketball,bowling_ale,cigar_room,conference_room,home_theatre,coffee_longue,library,jacuzzi) VALUES
        ('$a1','$a2','$a10','$a11','$a12','$a13','$a14','$a15','$a16','$a17','$a18','$a19','$a20','$a21','$a22',
        '$a23','$a24','$a25','$a26','$a27','$a28','$a29','$a30','$a31','$a32','$a33','$a34','$a35','$a36',
        '$a37','$a38')";
        
        $q6 = "INSERT INTO floorplans(name,image_1,image_2,image_3,doc,type1,size1,prize1,type2,size2,prize2,type3,size3,prize3,type4,size4,prize4) VALUES('$a2','$new_img_name4','$new_img_name5','$new_img_name6','$upload_file1','$a39','$a40','$a41','$a42','$a43','$a44','$a45','$a46','$a47','$a48','$a49','$a50')";

        if ($con->query($q3) === TRUE && $con->query($q4) === TRUE && $con->query($q5) === TRUE && $con->query($q6) === TRUE) {
            echo "<script> alert('New Property Added ! Please Add Gallery Images for the property ! ') </script>";
            echo "<script> window.location='./gallery.php?name=<?php echo $a1; ?>'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    // } else {
    //     echo "<script> alert('Please upload images only in image format!') </script>";
    // }
}

if (isset($_POST['update_property'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['type']);
    $a2 = mysqli_real_escape_string($con, $_POST['name']);
    $a3 = mysqli_real_escape_string($con, $_POST['description']);
    $a5 = mysqli_real_escape_string($con, $_POST['size']);
    $a6 = mysqli_real_escape_string($con, $_POST['price']);
    $a7 = mysqli_real_escape_string($con, $_POST['area']);
    $a8 = mysqli_real_escape_string($con, $_POST['location']);
    $a9 = mysqli_real_escape_string($con, $_POST['city']);
    $a10 = mysqli_real_escape_string($con, $_POST['id']);
    $a11 = mysqli_real_escape_string($con, $_POST['construction']);
    $img = $_FILES['image']['name'];
    $brochure = $_FILES["brochure"]["name"];
    $cover_img = $_FILES["cover_image"]["name"];
    $video = $_FILES["video"]["name"];

    if (empty($img)) {
        $q3 = "UPDATE properties SET property_categories='$a1' , name='$a2' , description='$a3' ,
        map_link = '$a8' , city = '$a9' , size='$a5' , price='$a6' , property_area='$a7'
         WHERE id='$a10', construction='$a11'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./show_property.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Property-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Property Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);

            $q3 = "UPDATE properties SET property_categories='$a1' , name='$a2' , description='$a3' ,
        map_link = '$a8' , city = '$a9', size='$a5' , price='$a6' , property_area='$a7',image='$new_img_name' ,construction='$a11' WHERE id='$a10'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Updated !') </script>";
                echo "<script> window.location='./show_property.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }

    if (!empty($brochure)) {
        $temp = explode(".", $_FILES["brochure"]["name"]);
        $extension = end($temp);
        //$upload_file = $_FILES["pdf"]["name"];
        $upload_file = uniqid("Brochure - ", true) . '.' . $extension;
        move_uploaded_file($_FILES["brochure"]["tmp_name"], "Uploads/Docs/" . $upload_file);

        $q3 = "UPDATE properties SET property_categories='$a1' , name='$a2' , description='$a3' , construction='$a11'
        map_link = '$a8' , city = '$a9', size='$a5' , price='$a6' , property_area='$a7',brochure='$upload_file' WHERE id='$a10'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Updated !') </script>";
            echo "<script> window.location='./show_property.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    }

    if (!empty($cover_img)) {

        //----------------------------Cover Image Start
        $img_name2 = $_FILES['cover_image']['name'];
        $img_size2 = $_FILES['cover_image']['size'];
        $img_tmpname2 = $_FILES['cover_image']['tmp_name'];
        $error2 = $_FILES['cover_image']['error'];
        //----------------------------Cover Image End

        $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
        $img_ex_lc2 = strtolower($img_ex2);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc2, $allowed_ex)) {

            //--------------------------------- Cover Image Start
            $new_img_name2 = uniqid("Cover-", true) . '.' . $img_ex_lc2;
            $img_upload_path2 = 'Uploads/Videos/' . $new_img_name2;
            move_uploaded_file($img_tmpname2, $img_upload_path2);
            //--------------------------------- Cover Image End

            $q3 = "UPDATE video SET image='$new_img_name2' WHERE name='$a2'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Updated !') </script>";
                echo "<script> window.location='./show_property.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }

    if (!empty($video)) {

        //--------------------------------------- Video Start
        $img_name3 = $_FILES['video']['name'];
        $img_tmpname3 = $_FILES['video']['tmp_name'];
        $img_ex3 = pathinfo($img_name1, PATHINFO_EXTENSION);
        $img_ex_lc3 = strtolower($img_ex3);

        $new_img_name3 = uniqid("Video-", true) . '.' . $img_ex_lc3;
        $img_upload_path3 = 'Uploads/Videos/' . $new_img_name3;
        move_uploaded_file($img_tmpname3, $img_upload_path3);
        // ---------------------------------------Video End

        $q3 = "UPDATE video SET video='$new_img_name3' WHERE name='$a2'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Updated !') </script>";
            echo "<script> window.location='./show_property.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    }
}

/*if (isset($_POST['add_amenities'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['type']);
    $a2 = mysqli_real_escape_string($con, $_POST['name']);

    $s = "SELECT * FROM amenities WHERE property_name='$a2'";
    $row = mysqli_num_rows(mysqli_query($con, $s));
    if ($row > 0) {
        echo "<script> alert('Amenities Have Been Added for This Property Previously ! Please Select Another Property') </script>";
        echo "<script> window.location='./property_amenities.php'</script>  ";
    } else {

        $a3 = mysqli_real_escape_string($con, $_POST['MasterTemplate']);
        $a4 = mysqli_real_escape_string($con, $_POST['FacingClubhouse']);
        $a5 = mysqli_real_escape_string($con, $_POST['AllWeatherPool']);
        $a6 = mysqli_real_escape_string($con, $_POST['LavishInteriors']);
        $a7 = mysqli_real_escape_string($con, $_POST['ServantRoom']);
        $a8 = mysqli_real_escape_string($con, $_POST['Clubhouse']);
        $a9 = mysqli_real_escape_string($con, $_POST['Gymnasium']);
        $a10 = mysqli_real_escape_string($con, $_POST['Garden']);
        $a11 = mysqli_real_escape_string($con, $_POST['PrivateCinema']);
        $a12 = mysqli_real_escape_string($con, $_POST['YogaRoom']);
        $a13 = mysqli_real_escape_string($con, $_POST['PlotSizes']);
        $a14 = mysqli_real_escape_string($con, $_POST['BanquetHall']);
        $a15 = mysqli_real_escape_string($con, $_POST['Restaurant']);
        $a16 = mysqli_real_escape_string($con, $_POST['SquashCourt']);
        $a17 = mysqli_real_escape_string($con, $_POST['PoolTable']);
        $a18 = mysqli_real_escape_string($con, $_POST['Bar']);
        $a19 = mysqli_real_escape_string($con, $_POST['KidsPlay']);
        $a20 = mysqli_real_escape_string($con, $_POST['Badminton']);
        $a21 = mysqli_real_escape_string($con, $_POST['CentralGarden']);
        $a22 = mysqli_real_escape_string($con, $_POST['units']);
        $a23 = mysqli_real_escape_string($con, $_POST['CricketPitch']);
        $a24 = mysqli_real_escape_string($con, $_POST['BasketballGround']);
        $a25 = mysqli_real_escape_string($con, $_POST['BowlingAle']);
        $a26 = mysqli_real_escape_string($con, $_POST['CigarRoom']);
        $a27 = mysqli_real_escape_string($con, $_POST['ConferenceRoom']);
        $a28 = mysqli_real_escape_string($con, $_POST['HomeTheatre']);
        $a29 = mysqli_real_escape_string($con, $_POST['CoffeeLongue']);
        $a30 = mysqli_real_escape_string($con, $_POST['Library']);
        $a31 = mysqli_real_escape_string($con, $_POST['jacuzzi']);

        $q3 = "INSERT INTO amenities(property_type,property_name,master_template,facing_clubhouse,all_weather_pool,
    lavish_interiors,servant_room,clubhouse,gym,garden,private_cinema,yoga_room,plot_sizes,banquet_hall,restaurant,squash_court,pool_table,bar,kids_play,badminton,central_garden,units,cricket_pitch,basketball,bowling_ale,cigar_room,conference_room,home_theatre,coffee_longue,library,jacuzzi) VALUES
    ('$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11','$a12','$a13','$a14','$a15',
    '$a16','$a17','$a18','$a19','$a20','$a21','$a22','$a23','$a24','$a25','$a26','$a27','$a28','$a29',
    '$a30','$a31')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Amenities Added !') </script>";
            echo "<script> window.location='./property_amenities.php'</script>  ";
        } else {
            //echo "Error " . $con->error;
        }
    }
}*/

/*if (isset($_POST['add_video'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['category']);
    $a2 = mysqli_real_escape_string($con, $_POST['name']);

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc = strtolower($img_ex);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc, $allowed_ex)) {
        $new_img_name = uniqid("Cover -", true) . '.' . $img_ex_lc;
        $img_upload_path = 'Uploads/Videos/' . $new_img_name;
        move_uploaded_file($img_tmpname, $img_upload_path);
        //$compress_file = "compress_" . $new_img_name;
        //$compressed_img = "uploads/Blog Images/" . $new_img_name;
        //$compress_name = compressImage($img_upload_path, $compressed_img);

        $q3 = "INSERT INTO video(category,name,image,video) VALUES('$a1','$a2','$new_img_name','$new_img_name1')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Video Added !') </script>";
            echo "<script> window.location='./video.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload images only in image format!') </script>";
    }
}*/

if (isset($_POST['add_slot'])) {
    $a2 = mysqli_real_escape_string($con, $_POST['name']);
    $a3 = mysqli_real_escape_string($con, $_POST['date']);
    $a4 = mysqli_real_escape_string($con, $_POST['time']);

    $q3 = "INSERT INTO timeslot(name,date,slot) VALUES('$a2','$a3','$a4')";

    if ($con->query($q3) === TRUE) {
        echo "<script> alert('New Slot Added !') </script>";
        echo "<script> window.location='./time_slots.php'</script>  ";
    } else {
        echo "Error " . $con->error;
    }
}

if (isset($_POST['add_slide'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['heading']);
    $a2 = mysqli_real_escape_string($con, $_POST['description']);

    //--------------------------------- Image 1 Start
    $img_name1 = $_FILES['image']['name'];
    $img_size1 = $_FILES['image']['size'];
    $img_tmpname1 = $_FILES['image']['tmp_name'];
    $error1 = $_FILES['image']['error'];
    //--------------------------------- Image 1 End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc1, $allowed_ex)) {

        //--------------------------------- Image 1 Start
        $new_img_name1 = uniqid("Slider-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/Slide Images/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //--------------------------------- Image 1 End        

        $q3 = "INSERT INTO slides(image,heading,description) VALUES('$new_img_name1','$a1','$a2')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Slider Image Added !') </script>";
            echo "<script> window.location='./slides.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload images only in image format!') </script>";
    }
}

if (isset($_POST['update_slide'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['heading']);
    $a2 = mysqli_real_escape_string($con, $_POST['description']);
    $a3 = mysqli_real_escape_string($con, $_POST['id']);
    $img = $_FILES['image']['name'];

    if (empty($img)) {
        $q3 = "UPDATE slides SET heading='$a1' , description='$a2' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./slides.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Slider-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Slide Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);

            $q3 = "UPDATE slides SET heading='$a1' , description='$a2' , image='$new_img_name' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./slides.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}

if (isset($_POST['add_testimonial'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['message']);

    //--------------------------------- Image 1 Start
    $img_name1 = $_FILES['image']['name'];
    $img_size1 = $_FILES['image']['size'];
    $img_tmpname1 = $_FILES['image']['tmp_name'];
    $error1 = $_FILES['image']['error'];
    //--------------------------------- Image 1 End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc1, $allowed_ex)) {

        //--------------------------------- Image 1 Start
        $new_img_name1 = uniqid("Testimonial-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/Testimonial Images/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //--------------------------------- Image 1 End        

        $q3 = "INSERT INTO testimonials(name,image,message) VALUES('$a1','$new_img_name1','$a2')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Testimonial Added !') </script>";
            echo "<script> window.location='./testimonials.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload images only in image format!') </script>";
    }
}

if (isset($_POST['update_testimonial'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['message']);
    $a3 = mysqli_real_escape_string($con, $_POST['id']);
    $img = $_FILES['image']['name'];

    if (empty($img)) {
        $q3 = "UPDATE testimonials SET name='$a1' , message='$a2' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./testimonials.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Testimonial-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Testimonial Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);

            $q3 = "UPDATE testimonials SET name='$a1' , message='$a2' , image='$new_img_name' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./testimonials.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}

if (isset($_POST['add_floorplan'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);

    //--------------------------------- Floorplan Image 1 Start
    $img_name1 = $_FILES['image_1']['name'];
    $img_size1 = $_FILES['image_1']['size'];
    $img_tmpname1 = $_FILES['image_1']['tmp_name'];
    $error1 = $_FILES['image_1']['error'];
    //--------------------------------- Floorplan Image 1 End

    //--------------------------------- Floorplan Image 2 Start
    $img_name2 = $_FILES['image_2']['name'];
    $img_size2 = $_FILES['image_2']['size'];
    $img_tmpname2 = $_FILES['image_2']['tmp_name'];
    $error2 = $_FILES['image_2']['error'];
    //--------------------------------- Floorplan Image 2 End

    //--------------------------------- Floorplan Image 3 Start
    $img_name3 = $_FILES['image_3']['name'];
    $img_size3 = $_FILES['image_3']['size'];
    $img_tmpname3 = $_FILES['image_3']['tmp_name'];
    $error3 = $_FILES['image_3']['error'];
    //--------------------------------- Floorplan Image 3 End
    
    //---------------------------------- Floorplan Document Start
    $temp = explode(".", $_FILES["floorplan"]["name"]);
    $extension = end($temp);
    //$upload_file = $_FILES["pdf"]["name"];
    $upload_file = uniqid("Floorplan - ", true) . '.' . $extension;
    move_uploaded_file($_FILES["floorplan"]["tmp_name"], "Uploads/Floorplan Images/" . $upload_file);
    //---------------------------------- Floorplan Document End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
    $img_ex3 = pathinfo($img_name3, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $img_ex_lc2 = strtolower($img_ex2);
    $img_ex_lc3 = strtolower($img_ex3);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc1, $allowed_ex) || in_array($img_ex_lc2, $allowed_ex) || in_array($img_ex_lc3, $allowed_ex)) {

        //--------------------------------- Image 1 Start
        $new_img_name1 = uniqid("Floorplan_1-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/Floorplan Images/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //$compress_file1 = "compress_" . $new_img_name1;
        //$compressed_img1 = "uploads/Gallery Images/" . $new_img_name1;
        //$compress_name1 = compressImage($img_upload_path1, $compressed_img1);
        //--------------------------------- Image 1 End

        //--------------------------------- Image 2 Start
        $new_img_name2 = uniqid("Floorplan_2-", true) . '.' . $img_ex_lc2;
        $img_upload_path2 = 'Uploads/Floorplan Images/' . $new_img_name2;
        move_uploaded_file($img_tmpname2, $img_upload_path2);
        //$compress_file2 = "compress_" . $new_img_name2;
        //$compressed_img2 = "uploads/Gallery Images/" . $new_img_name2;
        //$compress_name2 = compressImage($img_upload_path2, $compressed_img2);
        //--------------------------------- Image 2 End

        //--------------------------------- Image 3 Start
        $new_img_name3 = uniqid("Floorplan_3-", true) . '.' . $img_ex_lc3;
        $img_upload_path3 = 'Uploads/Floorplan Images/' . $new_img_name3;
        move_uploaded_file($img_tmpname3, $img_upload_path3);
        //$compress_file3 = "compress_" . $new_img_name3;
        //$compressed_img3 = "uploads/Gallery Images/" . $new_img_name3;
        //$compress_name3 = compressImage($img_upload_path3, $compressed_img3);
        //--------------------------------- Image 3 End

        $q3 = "INSERT INTO floorplans(name,image_1,image_2,image_3,doc) VALUES('$a1','$new_img_name1','$new_img_name2','$new_img_name3','$upload_file')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Floorplan Images / Documents Added !') </script>";
            echo "<script> window.location='./floorplan.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload images only in image format!') </script>";
    }
}

if (isset($_POST['add_floorplan_table'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['tbl_name']);
    $a2 = mysqli_real_escape_string($con, $_POST['tbl_type']);
    $a3 = mysqli_real_escape_string($con, $_POST['tbl_size']);
    $a4 = mysqli_real_escape_string($con, $_POST['tbl_price']);

    $q3 = "INSERT INTO floorplans(name , type , size , price)VALUE('$a1','$a2','$a3','$a4')";

    if ($con->query($q3) === TRUE) {
        echo "<script> alert('New Floorplan Table Added !') </script>";
        echo "<script> window.location='./floorplan.php'</script>  ";
    } else {
        echo "Error " . $con->error;
    }
}

if (isset($_POST['add_team'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['post']);
    $a3 = mysqli_real_escape_string($con, $_POST['field']);
    $a4 = mysqli_real_escape_string($con, $_POST['description']);
    $a5 = mysqli_real_escape_string($con, $_POST['contact']);
    $a6 = mysqli_real_escape_string($con, $_POST['email']);

    //--------------------------------- Image 1 Start
    $img_name1 = $_FILES['image']['name'];
    $img_size1 = $_FILES['image']['size'];
    $img_tmpname1 = $_FILES['image']['tmp_name'];
    $error1 = $_FILES['image']['error'];
    //--------------------------------- Image 1 End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc1, $allowed_ex)) {

        //--------------------------------- Image 1 Start
        $new_img_name1 = uniqid("Team-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/Team Images/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //--------------------------------- Image 1 End        

        $q3 = "INSERT INTO our_team(name,image,post,field,description,mobile_no,email) VALUES('$a1','$new_img_name1','$a2','$a3','$a4','$a5','$a6')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New Team Member Added !') </script>";
            echo "<script> window.location='./team.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload images only in image format!') </script>";
    }
}

if (isset($_POST['update_team'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['post']);
    $a3 = mysqli_real_escape_string($con, $_POST['field']);
    $a4 = mysqli_real_escape_string($con, $_POST['description']);
    $a5 = mysqli_real_escape_string($con, $_POST['contact']);
    $a6 = mysqli_real_escape_string($con, $_POST['id']);
    $a7 = mysqli_real_escape_string($con, $_POST['email']);
    $img = $_FILES['image']['name'];

    if (empty($img)) {
        $q3 = "UPDATE our_team SET name='$a1' , post='$a2' , field='$a3' , description='$a4' , mobile_no='$a5' , email='$a7' WHERE id='$a6'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Updated!') </script>";
            echo "<script> window.location='./team.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_tmpname = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Team-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/Team Images/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);

            $q3 = "UPDATE our_team SET name='$a1' , post='$a2' , field='$a3' , description='$a4' , mobile_no='$a5' , email='$a7' , image='$new_img_name' WHERE id='$a6'";


            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Updated !') </script>";
                echo "<script> window.location='./team.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload images only in image format!') </script>";
        }
    }
}

if (isset($_POST['add_faq'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['question']);
    $a3 = mysqli_real_escape_string($con, $_POST['answer']);

    $q3 = "INSERT INTO faq(name,question,answer) VALUES ('$a1','$a2','$a3')";

    if ($con->query($q3) === TRUE) {
        echo "<script> alert('New FAQ Added !') </script>";
        echo "<script> window.location='./faq.php'</script>  ";
    } else {
        echo "Error " . $con->error;
    }
}

if (isset($_POST['update_faq'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['question']);
    $a3 = mysqli_real_escape_string($con, $_POST['answer']);
    $a4 = mysqli_real_escape_string($con, $_POST['id']);

    $q3 = "UPDATE faq SET name='$a1' , question='$a2' , answer='$a3' WHERE id='$a4'";

    if ($con->query($q3) === TRUE) {
        echo "<script> alert('Updated !') </script>";
        echo "<script> window.location='./faq.php'</script>  ";
    } else {
        echo "Error " . $con->error;
    }
}


if (isset($_POST['add_client'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['website']);

    //--------------------------------- Image 1 Start
    $img_name1 = $_FILES['logo']['name'];
    $img_size1 = $_FILES['logo']['size'];
    $img_tmpname1 = $_FILES['logo']['tmp_name'];
    $error1 = $_FILES['logo']['error'];
    //--------------------------------- Image 1 End

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    //echo "$img_ex";
    $img_ex_lc1 = strtolower($img_ex1);
    $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

    if (in_array($img_ex_lc1, $allowed_ex)) {

        //--------------------------------- Image 1 Start
        $new_img_name1 = uniqid("Client-", true) . '.' . $img_ex_lc1;
        $img_upload_path1 = 'Uploads/client/' . $new_img_name1;
        move_uploaded_file($img_tmpname1, $img_upload_path1);
        //--------------------------------- Image 1 End        

        $q3 = "INSERT INTO clients(logo,name,website) VALUES('$new_img_name1','$a1','$a2')";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('New logo Added !') </script>";
            echo "<script> window.location='./client.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        echo "<script> alert('Please upload logo only in PNG/JPG format!') </script>";
    }
}

if (isset($_POST['update_client'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['website']);
    $a3 = mysqli_real_escape_string($con, $_POST['id']);
    $img = $_FILES['image']['name'];

    if (empty($img)) {
        $q3 = "UPDATE clients SET name='$a1' , website='$a2' WHERE id='$a3'";

        if ($con->query($q3) === TRUE) {
            echo "<script> alert('Update!') </script>";
            echo "<script> window.location='./client.php'</script>  ";
        } else {
            echo "Error " . $con->error;
        }
    } else {
        $img_name = $_FILES['logo']['name'];
        $img_size = $_FILES['logo']['size'];
        $img_tmpname = $_FILES['logo']['tmp_name'];
        $error = $_FILES['logo']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //echo "$img_ex";
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "png", "jpeg", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_ex)) {
            $new_img_name = uniqid("Client-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'Uploads/client/' . $new_img_name;
            move_uploaded_file($img_tmpname, $img_upload_path);

            $q3 = "UPDATE clients SET name='$a1' , website='$a2' , logo='$new_img_name' WHERE id='$a3'";

            if ($con->query($q3) === TRUE) {
                echo "<script> alert('Update !') </script>";
                echo "<script> window.location='./client.php'</script>  ";
            } else {
                echo "Error " . $con->error;
            }
        } else {
            echo "<script> alert('Please upload logo only in PNG/JPG format!') </script>";
        }
    }
}


if (isset($_POST['add_seo'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['type']);
    $a3 = mysqli_real_escape_string($con, $_POST['text']);

    $q3 = "INSERT INTO seo(name,type,text) VALUES ('$a1','$a2','$a3')";

    if ($con->query($q3) === TRUE) {
        echo "<script> alert('New SEO Added !') </script>";
        echo "<script> window.location='./seo.php'</script>  ";
    } else {
        echo "Error " . $con->error;
    }
}

if (isset($_POST['update_seo'])) {
    $a1 = mysqli_real_escape_string($con, $_POST['name']);
    $a2 = mysqli_real_escape_string($con, $_POST['type']);
    $a3 = mysqli_real_escape_string($con, $_POST['text']);
    $a4 = mysqli_real_escape_string($con, $_POST['id']);

    $q3 = "UPDATE seo SET name='$a1' , type='$a2' , text='$a3' WHERE id='$a4'";

    if ($con->query($q3) === TRUE) {
        echo "<script> alert('Updated !') </script>";
        echo "<script> window.location='./seo.php'</script>  ";
    } else {
        echo "Error " . $con->error;
    }
}
?>