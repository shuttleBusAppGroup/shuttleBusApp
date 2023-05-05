<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'config.php';

if(count($_POST)>0) {
mysqli_query($db_connection,"UPDATE announcements set announce_id='" . $_POST['announce_id'] . "', title='" . $_POST['title'] . "', message='" . $_POST['message'] . "', addedOn=now() ,deleteOn='" . $_POST['deleteOn'] . "' WHERE announce_id='" . $_POST['announce_id'] . "'");
$message = "Announcement has been updated";
}
$result = mysqli_query($db_connection,"SELECT * FROM announcements WHERE announce_id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
		<meta charset = "utf-8">
		<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.comd/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<title>Edit Announcement</title>
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
				<li class="nav-item">
					<a class="nav-link btn btn-success" href="announcements.php">MAKE ANNOUNCEMENT</a>
				</li>
			</ul>
		</div>
	</nav>
 <div>
<h1 style="text-align:center";>Shuttle Bus App</h1>
<h2>Edit Announcement</h2>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<div style="padding-bottom:5px;">
<a href="announcements.php">See All Announcements</a>
</div>

<div><label>Announcement ID:</label>
<input type="hidden" name="announce_id" class="txtField" value="<?php echo $row['announce_id']; ?>">
<input type="text" name="announce_id"  value="<?php echo $row['announce_id']; ?>"></div>
<div><label>Title:</label>
<input type="text" name="title" class="txtField" value="<?php echo $row['title']; ?>"></div>
<div><label>Announcement:</label>
<input type="text" name="message" class="txtField" value="<?php echo $row['message']; ?>"></div>
<div><label>Updated On:</label>
<input type="datetime-local" name="addedOn" class="txtField" value="<?php echo $row['addedOn']; ?>"></div>
<div><label>Delete On:</label>
<input type="datetime-local" name="deleteOn" class="txtField" value="<?php echo $row['deleteOn']; ?>"></div>
<input type="submit" style="margin-left:4px" name="submit" value="Update" class="buttom">

</form>
</body>
</html>
