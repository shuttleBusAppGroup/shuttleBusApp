<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include your config.php file to use the existing database connection
include 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "user") {
    header("Location: index.php");
    exit();
}

$routeResult = mysqli_query($db_connection, "SELECT routes.route_id, routes.route_name, routes.origin, routes.destination, routes.stops, routes.estimated_time, buses.bus_number 
FROM routes JOIN buses ON routes.route_id = buses.id");

$stmt = $db_connection->prepare("SELECT COUNT(*) FROM users");

// Execute the query
$stmt->execute();

// Fetch the user count
$result = $stmt->get_result();
$user_count = $result->fetch_row()[0];

// Close the statement to free up resources
$stmt->close();

// Prepare the SQL statement to get the announcements
$stmt2 = $db_connection->prepare("SELECT * FROM announcements");

// Execute the query
$stmt2->execute();

// Fetch the announcements
$announcementsResult = $stmt2->get_result();

// Close the statement to free up resources
$stmt2->close();



?>
<!DOCTYPE html>
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
          <a class="navbar-brand" href="user_dashboard.php">User Dashboard</a>
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

    <main role="main">
        <!-- Add the container div to wrap the content -->
        <div class="container col-md 8" style="padding-top: 70px;">
            <br><br>
                <h1>User Dashboard</h1>
                <p class="lead">Welcome, <?php echo $_SESSION["username"]; ?>!<br>
                    <?php
                    $eastCoastTimezone = new DateTimeZone("America/New_York");
                    $currentEastCoastTime = new DateTime("now", $eastCoastTimezone);
                    echo "Current East Coast Time: " . $currentEastCoastTime->format("h:i A");
                    ?>
                </p>

    
        <h3>Shuttle Bus Announcements</h3>
        <?php
        // Display the announcements in a table
        if (mysqli_num_rows($announcementsResult) > 0) {
            echo '<table class="table table-hover">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Title</th>';
            echo '<th>Message</th>';
            echo '<th>Added On</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_array($announcementsResult)) {
                echo '<tr>';
                echo '<td>' . $row["title"] . '</td>';
                echo '<td>' . $row["message"] . '</td>';
                echo '<td>' . $row["addedOn"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No announcements found";
        }
        ?>
        <?php
        if (mysqli_num_rows($routeResult) > 0) {
        ?>
        <h3> Shuttle Bus Schedule</h3>
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
    </main>
</div> <!-- Close the container div -->

<!-- Footer -->


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
        <script>
        function updateSeconds() {
            var now = new Date();
            var seconds = now.getSeconds();
            var secondsSpan = document.getElementById("seconds");
            secondsSpan.innerText = " : " + (seconds < 10 ? "0" : "") + seconds;
        }

        setInterval(updateSeconds, 1000);
        </script>

</body>
</html>