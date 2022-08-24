<?php
    require 'connection.php';
    $email= mysqli_real_escape_string($con, strip_tags($_POST['email']));
    $password= mysqli_real_escape_string($con, strip_tags($_POST['password']));
    //$password=$_POST['password'];
    $select_query="select * from admin where email='$email'";
    $select_query_result= mysqli_query($con, $select_query) or die(mysqli_error($con));
    $num_rows= mysqli_num_rows($select_query_result);

    if($num_rows==1){
        $array= mysqli_fetch_array($select_query_result);
        $pass = $array['password'];
        if (password_verify($password, $pass)){
            $_SESSION['admin_email']=$array['email'];
            $_SESSION['admin_id']=$array['id'];
            $_SESSION['admin_name']=$array['name'];
            header('location:index.php');
        }
        else{
            echo '<script>alert("Incorrect Password!"); window.location.href = `login.php`</script>';
        }
    }
    else{
        echo '<script>alert("Invalid login!"); window.location.href = `login.php`</script>';
    }
?>
