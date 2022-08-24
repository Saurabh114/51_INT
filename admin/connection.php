<?php

$servername = 'localhost';
$username = 'hspmdev';
$password = 'hspm@developers';
$database = 'fifty1';

$con = mysqli_connect($servername,$username,$password,$database) or die(mysqli_error());
session_start();
?>