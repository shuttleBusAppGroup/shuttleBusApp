<?php
include_once 'db.php';
$result = mysqli_query($conn,"SELECT * FROM announcements WHERE deleteOn >= NOW()");
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
 <title>User Dashboard</title>

<style>
    .fa_custom {color: #F4BB44}
	th{color: black;}
    td{
      text-align:left; font-size: 17px;}
    
	
	h1 { text-align-align: center;}
	
	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 500px;
	margin-left: auto;
	margin-right: auto;
	outline-color:black;}

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

<h1 style="text-align: center;">Shuttle Bus App</h1>
<h2>User Dashboard</h2>

<?php
if (mysqli_num_rows($result) > 0) {
?>
  <table class="center table-hover" style="border: 2px lightgrey solid">
  
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr style = "background-color:#F0E68C" background="yellow;">

    <th><i class="fa fa-exclamation-circle fa_custom fa-2x"></i>
 <?php echo $row["title"]; ?></th>
</tr>
<tr style = "background-color:#F0E68C;">
    <td><?php echo $row["message"]; ?></td>
</tr>
<tr style = "background-color:#F0E68C;">
    <td style="font-size:10px;">Update made on <?php echo $row["addedOn"]; ?></td>  
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
