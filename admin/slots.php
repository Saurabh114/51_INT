<?php
include 'connection.php';


if(isset($_POST["d_id"])){
	$p_id= $_POST['d_id'];
    //Get all city data
    $query = "SELECT * FROM timeslot WHERE date = '$p_id'";
    // ORDER BY department ASC
    $run_query = mysqli_query($con, $query);
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display cities list
    
        echo '<option value="">Select Time Slot</option>';
        while($row = mysqli_fetch_assoc($run_query)){
            
		$city_id=$row['slot'];
        echo "<option value='$city_id'>$city_id</option>";
        }
}
?>