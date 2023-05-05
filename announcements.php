<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


// Include your config.php file to use the existing database connection
include 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "driver") {
    header("Location: index.php");
    exit();
}
$result = mysqli_query($db_connection, "SELECT * FROM announcements");

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

    
 <title>Announcements</title>

<style>
	th{color: white;}
    td{
      text-align:left; font-size: 17px;
    }
    .table-hover tbody tr:hover td {background-color: #B76774;}
    .table-hover tbody tr:hover th
	
	h1 { text-align: center;}
	
	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;}

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
					<a class="nav-link" href="driver_dashboard.php">Home</a>
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
				<li class="nav-item" style="font-weight: bold;">
					<a class="nav-link btn btn-success" href="announcements.php">MAKE ANNOUNCEMENT</a>
				</li>
			</ul>
		</div>
	</nav>
 <div>

<h1 style="text-align: center;">Shuttle Bus App</h1>
<h2>Announcements History</h2>

<p><a href = "announce_index.php" class="btn btn-primary">ADD AN ANNOUNCEMENT</a></p>

<?php
if (mysqli_num_rows($result) > 0) {
?>
  <table class="table table-bordered table-striped table table-hover">
  
  <tr style="background-color:darkgrey;">
    <th>Announcement ID</th>
    <th>Title</th>
    <th>Message</th>
    <th>Added On</th>
    <th>Delete On</th>
    <th>Action</th>
  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
    <td><?php echo $row["announce_id"]; ?></td>
    <td><?php echo $row["title"]; ?></td>
    <td><?php echo $row["message"]; ?></td>
    <td><?php echo $row["addedOn"]; ?></td>
    <td><?php echo $row["deleteOn"]; ?></td>
    <td><a href="announce_edit.php?id=<?php echo $row["announce_id"];?>" class="btn btn-secondary">Update</a>
	<br>
    <a href="announce_delete.php?announce_id=<?php echo $row["announce_id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</a>


</td>
</tr>
<?php
$i++;
}
?>
</table>
 <?php
}
else{
    echo "No result found";
}
?>
 </body>
</html>
