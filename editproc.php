<!DOCTYPE html>
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

if (count($_POST) > 0) {
	
    $stmt = $db_connection->prepare("UPDATE routes SET route_id=?, route_name=?, current_stop=?, next_stop=?, bus_id=?, current_time_stamp=NOW() WHERE route_id=?");
	$stmt->bind_param("isssii", $_POST['id'], $_POST['route_name'], $_POST['current_stop'], $_POST['next_stop'], $_POST['bus_id'], $_POST['original_id']);

    if ($stmt->execute()) {
        $message = "Route has been updated";
    } else {
        $message = "Error updating route: " . $stmt->error;
    }
    $stmt->close();
}

$result = mysqli_query($db_connection, "SELECT * FROM routes WHERE route_id='" . $_GET['route_id'] . "'");
$row = mysqli_fetch_array($result);
?>

<html>
<head>
	<meta charset = "utf-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Include your CSS and JavaScript files here -->
	<link rel="stylesheet" href="/css/stylesheet.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-primary">
		<div class="container">
			<a class="navbar-brand" href="index.php">Home</a>
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
		<h1 style="text-align:center";>Shuttle Bus App</h1>
		<h2>Edit Route</h2>
		<form name="frmUser" method="post" action="">
			<div><?php if(isset($message)) { echo $message; } ?>
			<div style="padding-bottom:5px;">
			<a href="retrieve.php">Go Back to update list</a>
	</div>
			<div>
				<label>Route ID:</label>
				<input type="hidden" name="original_id" class="txtField" value="<?php echo $row ? $row['route_id'] : ''; ?>">
				<input type="text" name="id" value="<?php echo $row ? $row['route_id'] : ''; ?>">
			</div>
			<div>
				<label>Route Name:</label>
				<input type="text" name="route_name" class="txtField" value="<?php echo $row ? $row['route_name'] : ''; ?>">
			</div>
			<div>
				<label>Route Start:</label>
				<input type="text" name="current_stop" class="txtField" value="<?php echo $row ? $row['current_stop'] : ''; ?>">
			</div>
			<div>
				<label>Route End:</label>
				<input type="text" name="next_stop" class="txtField" value="<?php echo $row ? $row['next_stop'] : ''; ?>">
			</div>
			<div>
				<label>Bus Number:</label>
				<input type="text" name="bus_id" class="txtField" value="<?php echo $row ? $row['bus_id'] : ''; ?>">
			</div>
			<div>
				<label>Arrival Time:</label>
				<input type="time" name="current_time_stamp" class="txtField" value="<?php echo $row ? $row['current_time_stamp'] : ''; ?>">
			</div>
			<div>
				<input type="submit" style="margin-left:4px" name="submit" value="Update" class="buttom">
			</div>

		</form>
</body>
</html>
