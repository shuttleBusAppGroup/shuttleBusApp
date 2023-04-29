<?php
include_once 'config.php';
if(count($_POST)>0) {
mysqli_query($conn,"UPDATE routes set id='" . $_POST['id'] . "', route_name='" . $_POST['route_name'] . "', route_start='" . $_POST['route_start'] . "', route_end='" . $_POST['route_end'] . "' ,bus_number='" . $_POST['bus_number'] . "',arrival_time='" . $_POST['arrival_time'] . "' WHERE id='" . $_POST['id'] . "'");
$message = "Route has been updated";
}
$result = mysqli_query($conn,"SELECT * FROM routes WHERE id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
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

		<title>Edit Form</title>
	<style>
		div {
			margin-left:4px;
			margin-bottom: 4px;
			}
		label {
			display:inline-block;
			width: 120px;
			text-align:left;
		}
		
		
	 .radian-shadow-left {
        text-align: center;
        text-shadow: -6px 0px 6px rgba(0, 0, 0, 0.5);
	  }
		.navbar {
			background-color: #007FFF;
		}
		.nav-link {
			color: white;
		}
		
		@media (max-width: 576px) {
			.navbar-nav {
				flex-direction: column;
				align-items: center;
				margin-top: 30px;
			}
			.nav-item {
				margin-bottom: 10px;
			}
		}
	</style>
	</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="retrieve.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contact.php">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="faqs.php">FAQs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Log Out</a>
				</li>
			</ul>
		</div>
	</nav>
 <div>
<h1 style="text-align:center";>Shuttle Bus App</h1>
<h2>Edit Route</h2>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<div style="padding-bottom:5px;">
<a href="retrieve.php">Go Back to List</a>
</div>

<div><label>Route ID:</label>
<input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>">
<input type="text" name="id"  value="<?php echo $row['id']; ?>"></div>
<div><label>Route Name:</label>
<input type="text" name="route_name" class="txtField" value="<?php echo $row['route_name']; ?>"></div>
<div><label>Route Start:</label>
<input type="text" name="route_start" class="txtField" value="<?php echo $row['route_start']; ?>"></div>
<div><label>Route End:</label>
<input type="text" name="route_end" class="txtField" value="<?php echo $row['route_end']; ?>"></div>
<div><label>Bus Number:</label>
<input type="text" name="bus_number" class="txtField" value="<?php echo $row['bus_number']; ?>"></div>
<div><label>Arrival Time:</label>
<input type="time" name="arrival_time" class="txtField" value="<?php echo $row['arrival_time']; ?>"></div>
<input type="submit" style="margin-left:4px" name="submit" value="Update" class="buttom">

</form>
</body>
</html>
