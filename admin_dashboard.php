<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include your config.php file to use the existing database connection
include 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "admin") {
    header("Location: index.php");
    exit();
}
$routeResult = mysqli_query($db_connection,"SELECT * FROM routes");
// Prepare the SQL statement to get the number of registered users
$stmt = $db_connection->prepare("SELECT COUNT(*) FROM users");

// Execute the query
$stmt->execute();

// Fetch the user count
$result = $stmt->get_result();
$user_count = $result->fetch_row()[0];

// Execute the query
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <!-- Character encoding for the document -->
        <meta charset="UTF-8">

        <!-- Viewport settings for responsiveness -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Page title -->
        <title>Admin Dashboard - Shuttle Bus App</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Your custom CSS -->
        <link rel="stylesheet" href="/css/stylesheet.css">

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>

        <!-- jQuery library -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Popper.js for Bootstrap tooltips and popovers -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- DataTables JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <!-- Your custom JavaScript file -->
        <script src="/js/admin_scripts.js"></script>

    </head>
    <body>

    <!-- Blue nav bar -->
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

    <!-- Main Section of Admin Page -->
    <div class="wrapper">
    <main class="main container mt-4 main-content">
        <div class="row">
            <div class="col">
                <h3 class="text-right">Admin Dashboard</h3>
                <p class="text-right">Welcome, <?php echo $_SESSION["username"]; ?></p>
                <h4 class="text-right">System Information</h4>
                <p class="text-right">Registered Users: <?php echo $user_count; ?></p>
                <br>
            
            </div>
        </div>

         <div id="map"></div>

  <script>
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: { lat: 40.862244, lng: -74.198863 }, // Initial center of the map
      });

      fetch('shuttle_positions.php')
        .then(response => response.json())
        .then(shuttlePositions => {
          shuttlePositions.forEach(position => {
            const shuttleMarker = new google.maps.Marker({
              position: new google.maps.LatLng(position.latitude, position.longitude),
              map: map,
              title: `Shuttle ${position.shuttle_id}`,
            });
          });
        })
        .catch(error => console.error('Error fetching shuttle positions:', error));
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAAZpiX72jxRTsrZdCKU50S3M6fNMUVucc&callback=initMap" async defer></script>

        
        
<!-- Insert new Route Section -->
<div class="row">
    <div class="col">
        <h2 class="text-center">Insert a New Route</h2>
        <br>
        <form method="post" action="insertproc.php" class="needs-validation" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="route_id">Route ID:</label>
                    <input type="text" class="form-control" id="route_id" name="route_id" required>
                    <div class="invalid-feedback">Please enter a route ID.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="route_name">Route name:</label>
                    <input type="text" class="form-control" id="route_name" name="route_name" required>
                    <div class="invalid-feedback">Please enter a route name.</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="current_stop">Route start:</label>
                    <input type="text" class="form-control" id="current_stop" name="current_stop" required>
                    <div class="invalid-feedback">Please enter a route start location.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="next_stop">Route end:</label>
                    <input type="text" class="form-control" id="next_stop" name="next_stop" required>
                    <div class="invalid-feedback">Please enter a route end location.</div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bus_id">Bus number:</label>
                    <input type="number" class="form-control" id="bus_id" name="bus_id" required>
                    <div class="invalid-feedback">Please enter a bus number.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="time_to_next_stop">Arrival time:</label>
                    <input type="time" class="form-control" id="time_to_next_stop" name="time_to_next_stop" required>
                    <div class="invalid-feedback">Please enter an arrival time.</div>
                </div>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
        
        <!-- Update or Delete Routes Section -->
        <div class="container">
            <h1 style="text-align: center;">Update or Delete Routes</h1>
            <h3 style="text-align: center;">Admin View</h3>
        </div>
        <br>

        <?php
        if (mysqli_num_rows($routeResult) > 0) {
        ?>

        <div class="scrollable-table">
            <table id="route-table" class="table table-bordered table-striped table table-hover">
                <thead class="thead-dark">
                    <tr style="text-align: center;">
                        <th>Bus No.</th>
                        <th>Route Name</th>
                        <th>Current Stop</th>
                        <th>Next Stop</th>
                        <th>Current Timestamp</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($routeResult)) {
                    ?>
                    <tr>
                        <td><?php echo $row["bus_id"]; ?></td>
                        <td><?php echo $row["route_name"]; ?></td>
                        <td><?php echo $row["current_stop"]; ?></td>
                        <td><?php echo $row["next_stop"]; ?></td>
                        <td><?php echo $row["current_time_stamp"]; ?></td>
                        <td>
                            <a href="editproc.php?route_id=<?php echo $row["route_id"];?>" class="btn btn-info">Update</a>
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
            </table>
        </div>

    <?php
    }
    else{
        echo "No result found";
    }
    ?>

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
    </div>



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
