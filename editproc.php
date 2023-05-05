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
    $stmt1 = $db_connection->prepare("UPDATE route_stops rs JOIN schedules s ON rs.route_id = s.route_id JOIN buses b ON s.id = b.id SET rs.stop_id=?, rs.arrival_time=? WHERE rs.id=?");
    $stmt1->bind_param("isi", $_POST['stop_id'], $_POST['arrival_time'], $_POST['route_stop_id']);

    // Check if capacity field is provided before executing the query
    if (!empty($_POST['capacity'])) {
        $stmt2 = $db_connection->prepare("UPDATE buses SET capacity=? WHERE id=?");
        $stmt2->bind_param("ii", $_POST['capacity'], $_POST['id']);

        // Check if bus_number field is provided before executing the query
        if (isset($_POST['bus_number'])) {
            $stmt2 = $db_connection->prepare("UPDATE buses SET bus_number=?, capacity=? WHERE id=?");
            $stmt2->bind_param("iii", $_POST['bus_number'], $_POST['capacity'], $_POST['id']);
        }

        if ($stmt1->execute() && $stmt2->execute()) {
            $message = "Route and Bus details have been updated";
        } else {
            $message = "Error updating route and bus details: " . $stmt1->error . " " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        $message = "Bus capacity field cannot be empty";
    }

    $stmt1->close();
}

if (isset($_GET['id'])) {
    $result = mysqli_query($db_connection, "SELECT r.*, b.bus_number, b.capacity FROM routes r JOIN buses b ON r.id = b.id WHERE r.id='" . $_GET['id'] . "'");
    $row = mysqli_fetch_array($result);
} else {
    // Handle the case when 'id' key is not set, e.g., set a default value, redirect, or show an error message
}




?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Route</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
        <![endif]-->
        <!-- Custom CSS -->
        <link rel="stylesheet" href="/css/stylesheet.css">
        <!-- Your custom JavaScript file -->
        <script src="/js/scripts.js"></script>
    </head>

    <body>
    <!-- Header -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="faq.php">FAQs</a></li>
            <li><a href="logout.php">Log out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Main Body -->
    <main>
        <div class="container-custom">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <br>
                    <h2 class="text-center">Edit Route</h2>

                    <form name="frmUser" method="post" action="" class="center-form">
                        <div><?php if(isset($message)) { echo $message; } ?></div>
                        <div style="padding-bottom:5px;">
                            <br>
                            <label>Bus Number:</label>
                            <select name="bus_number" required>
                                <?php
                                $result_bus = mysqli_query($db_connection, "SELECT * FROM buses");
                                while ($row_bus = mysqli_fetch_array($result_bus)) {
                                    echo "<option value='" . $row_bus['bus_number'] . "'>" . $row_bus['bus_number'] . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label>Bus Capacity:</label>
                            <select name="capacity">
                                <?php
                                for ($i = 1; $i <= 100; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label>Route ID:</label>
                            <select name="route_id">
                                <?php
                                $result_route = mysqli_query($db_connection, "SELECT * FROM routes");
                                while ($row_route = mysqli_fetch_array($result_route)) {
                                    echo "<option value='" . $row_route['id'] . "'>" . $row_route['id'] . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label>Bus ID:</label>
                            <select name="id">
                                <?php
                                $result_bus = mysqli_query($db_connection, "SELECT * FROM buses");
                                while ($row_bus = mysqli_fetch_array($result_bus)) {
                                    echo "<option value='" . $row_bus['id'] . "'>" . $row_bus['id'] . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label>Stop Name:</label>
                            <select name="stop_id">
                                <?php
                                $result_stop = mysqli_query($db_connection, "SELECT * FROM route_stops");
                                while ($row_stop = mysqli_fetch_array($result_stop)) {
                                    echo "<option value='" . $row_stop['stop_id'] . "'>" . $row_stop['stop_id'] . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label>Arrival Time:</label>
                            <select name="arrival_time">
                                <?php
                                for ($i = 0; $i <= 23; $i++) {
                                    for ($j = 0; $j <= 59; $j += 5) {
                                        $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        $minute = str_pad($j, 2, '0', STR_PAD_LEFT);
                                        echo "<option value='" . $hour . ":" . $minute . "'>" . $hour . ":" . $minute . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <br>
                            <input type="submit" style="margin-left:4px" name="submit" value="Update" class="btn btn-primary">
                            <button type="button" onclick="location.href='admin_dashboard.php'" class="btn btn-info">Back to Admin Dashboard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>

    <!-- Footer -->
        <br><br>
        <footer class="bg-dark text-center text-white">
            <div class="footer-copyright text-center py-3">
                <!-- Footer links -->
                <span class="text-muted">
                    <a href="privacy-policy.php">Privacy Policy</a> &middot; <a href="terms-of-service.php">Terms of Service</a>
                </span>
                &nbsp;&copy;
                <?php echo date("Y"); ?> University Shuttle Bus App. All Rights Reserved.
            </div>
        </footer>



        <!-- Bootstrap JavaScript dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSGFpoO/ufs3fOz9piXFXUprMCzT6T7ab8AmgF6ycrhSMly1E3y"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX5"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy4Ck4SOF4y4Ck4C2DgHfViXydVeLm+JDM"
        crossorigin="anonymous"></script>
    </body>
</html>
