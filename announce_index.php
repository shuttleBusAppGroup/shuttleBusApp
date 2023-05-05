<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'config.php';
$result = mysqli_query($db_connection,"SELECT * FROM announcements");
?>
<!DOCTYPE html>
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


        <title>Add Announcement</title>
	<style>
		
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
		div {
			margin-left:4px;
			margin-bottom: 4px;
			}
		label {
			display:inline-block;
			width: 120px;
			text-align:left;
		}
		h1 {margin-left:4px;}
	</style>
	</head>
  <body><nav class="navbar navbar-expand-sm navbar-dark">
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
				<li class="nav-item">
					<a class="nav-link btn btn-success" href="announcements.php">MAKE ANNOUNCEMENT</a>
				</li>
			</ul>
		</div>
	</nav>
 <div>
<h1 style="text-align:center";>Shuttle Bus App</h1>
	<h2>Make an Announcement</h2>
	<form method="post" action="announce_addproc.php">
		
<div style="padding-bottom:5px;">
<a href="announcements.php">See All Announcements</a>
</div>

		
		<div><label>Title:</label><input type="text" name="title"></div>
		<div><label>Announcement:</label>
		<textarea name="message"></textarea></div>
		<div><label>Added On:</label>
		<?php date_default_timezone_set('America/New_York');
				echo date("d-m-Y @h:i:sa"); ?></div>
		<div><label>Delete On:</label>
		<input type="datetime-local" name="deleteOn"></div>
		<input type="submit" style="margin-left:4px" name="save" value="Enter">

	</form>
  </body>
</html>
