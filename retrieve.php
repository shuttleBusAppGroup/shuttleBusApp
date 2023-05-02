<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "admin") {
	header("Location: index.php");
	exit();
}
$result = mysqli_query($db_connection,"SELECT * FROM routes");
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Include your CSS and JavaScript files here -->
	<link rel="stylesheet" href="/css/stylesheet.css">
    
	<title>Retrieve data</title>

</head>

<body>

<!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
      <a class="navbar-brand" href="admin_dashboard.php">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07"
        aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faq.php">FAQs</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <h1 style="text-align: center;">Route editor</h1>
    <h3 style="text-align: center;">Admin View</h3>
    <a href = "admin_dashboard.php" class="btn btn-primary">INSERT new route</a>
  </div>
  <br>

<div class="container">
<?php
if (mysqli_num_rows($result) > 0) {
?>
  <table class="table table-bordered table-striped table table-hover">
    <thead class="thead-dark">
      <tr>
        <th>Bus No.</th>
        <th>Route Name</th>
        <th>Route Start</th>
        <th>Route End</th>
        <th>Bus Number</th>
        <th>Current Timestamp</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    while($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $row["bus_id"]; ?></td>
        <td><?php echo $row["route_name"]; ?></td>
        <td><?php echo $row["current_stop"]; ?></td>
        <td><?php echo $row["next_stop"]; ?></td>
        <td><?php echo $row["bus_id"]; ?></td>
        <td><?php echo $row["current_time_stamp"]; ?></td>
        <td><a href="editproc.php?route_id=<?php echo $row["route_id"];?>" class="btn btn-info">Update</a>
        <br>
        <br>
        <a href="deleteproc.php?route_id=<?php echo $row["route_id"];?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this route?')">Delete</a>
    </td>
    </tr>
<?php
$i++;
}
?>
</tbody>
</div>
</table>
 <?php
}
else{
    echo "No result found";
}
?>
 </body>
</html>
