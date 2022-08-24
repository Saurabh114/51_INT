<?php
include('connection.php');
//echo $_SESSION['user_id'];
      session_unset();
      session_destroy();
      echo '<script> window.location.href="login.php";</script>';
?>