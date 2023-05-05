<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include your config.php file to use the existing database connection
include_once 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "admin") {
    header("Location: index.php");
    exit();
}

$routeResult = mysqli_query($db_connection, "SELECT routes.route_id, routes.route_name, routes.origin, routes.destination, routes.stops, routes.estimated_time, buses.bus_number 
FROM routes JOIN buses ON routes.route_id = buses.id");




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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>University Shuttle Bus App</title>
    
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

    <!-- Main Section of Admin Page -->
        <main class="main container mt-4 main-content">

            <!-- Insert new Route Section -->
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            <div class="row">
            <div class="col">
                <div class="form-container">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h2 class="text-center">Insert a New Route</h2>
                <br>
                <form method="post" action="insertproc.php" class="needs-validation form-group" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="origin">Origin:</label>
                            <input type="text" class="form-control" id="origin" name="origin" required>
                            <div class="invalid-feedback">Please enter an origin for this route.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="destination">Destination:</label>
                            <input type="text" class="form-control" id="destination" name="destination" required>
                            <div class="invalid-feedback">Please enter an origin for this route.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="route_id">Route ID:</label>
                            <input type="text" class="form-control" id="route_id" name="route_id" required>
                            <div class="invalid-feedback">Please enter a route ID.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="route_id">Route Name:</label>
                            <input type="text" class="form-control" id="route_name" name="route_name" required>
                            <div class="invalid-feedback">Please enter a route name.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bus_number">Bus Number:</label>
                            <input type="text" class="form-control" id="bus_number" name="bus_number" required>
                            <div class="invalid-feedback">Please enter a bus number for this route.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="stop_name">Stop Name:</label>
                            <input type="text" class="form-control" id="stop_name" name="stop_name" required>
                            <div class="invalid-feedback">Please enter a stop name.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="arrival_time">Arrival time:</label>
                            <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                            <div class="invalid-feedback">Please enter an arrival time.</div>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                </form>
            </div>
            </div>

                
                <!-- Update or Delete Routes Section -->
                <h2 style="text-align: center;">Update or Delete Routes</h2>
                <br>

                <?php
                if (mysqli_num_rows($routeResult) > 0) {
                ?>

                <div class="scrollable-table">
                <table id="routeTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Route ID</th>
                            <th>Route Name</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Stops</th>
                            <th>Estimated Time</th>
                            <th>Bus Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($routeResult)) { ?>
                            <tr>
                                <td><?php echo $row['route_id']; ?></td>
                                <td><?php echo $row['route_name']; ?></td>
                                <td><?php echo $row['origin']; ?></td>
                                <td><?php echo $row['destination']; ?></td>
                                <td><?php echo $row['stops']; ?></td>
                                <td><?php echo $row['estimated_time']; ?></td>
                                <td><?php echo $row['bus_number']; ?></td>
                                <td>
                            <form action="editproc.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['route_id']; ?>">
                                <button class="btn btn-primary btn-md">Edit</button>
                            </form>
                            <br>
                            <form action="deleteproc.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['route_id']; ?>">
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
            </table>

                </div>

            <?php
            }
            else{
                echo "No result found";
            }
            ?>
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