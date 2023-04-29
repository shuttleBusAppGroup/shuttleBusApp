<?php
include_once 'config.php';
if(isset($_POST['save']))
{	 
	 $id = $_POST['id']; 
	 $route_name = $_POST['route_name']; 
	 $route_start = $_POST['route_start'];
	 $route_end = $_POST['route_end'];
	 $bus_number = $_POST['bus_number'];
	 $arrival_time = $_POST['arrival_time'];
	 $sql = "INSERT INTO routes (id,route_name,route_start,route_end,bus_number,arrival_time)
	 VALUES ('$id','$route_name','$route_start','$route_end','$bus_number','$arrival_time')";
	 if (mysqli_query($conn, $sql)) {
		echo "New route created successfully !";
		header('Location:retrieve.php');
		exit;
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>
