<?php
include 'connection.php';


if(isset($_POST["p_id"])){
	$p_id= $_POST['p_id'];
    //Get all city data
    $query = "SELECT property_categories , name FROM properties WHERE property_categories = '$p_id'";
    // ORDER BY department ASC
    $run_query = mysqli_query($con, $query);
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display cities list
    
        echo '<option value="">Select Property Name </option>';
        while($row = mysqli_fetch_assoc($run_query)){
            
		$city_id=$row['name'];
        echo "<option value='$city_id'>$city_id</option>";
        }
}
?>