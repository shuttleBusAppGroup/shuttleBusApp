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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuttle Bus App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include your CSS and JavaScript files here -->
    <link rel="stylesheet" href="/css/stylesheet.css">
    <title>Admin Dashboard - Shuttle Bus App</title>
</head>
<body>

<!-- Header -->
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
  <main class="container mt-4">
    <div class="row">
        <div class="col">
            <h3 class="text-right">Admin Dashboard</h3>
            <p class="text-right">Welcome, <?php echo $_SESSION["username"]; ?></p>
            <h4 class="text-right">System Information</h4>
            <p class="text-right">Registered Users: <?php echo $user_count; ?></p>
            <br>
          
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2 class="text-center">Insert a New Route</h2>
            <br>
            <form method="post" action="insertproc.php" class="needs-validation" novalidate>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id">Route ID:</label>
                        <input type="text" class="form-control" id="id" name="id" required>
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
                        <label for="route_start">Route start:</label>
                        <input type="text" class="form-control" id="route_start" name="route_start" required>
                        <div class="invalid-feedback">Please enter a route start location.</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="route_end">Route end:</label>
                        <input type="text" class="form-control" id="route_end" name="route_end" required>
                        <div class="invalid-feedback">Please enter a route end location.</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="bus_number">Bus number:</label>
                        <input type="number" class="form-control" id="bus_number" name="bus_number" required>
                        <div class="invalid-feedback">Please enter a bus number.</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="arrival_time">Arrival time:</label>
                        <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                        <div class="invalid-feedback">Please enter an arrival time.</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            <a href="retrieve.php" class="btn btn-secondary" role="button">Edit Routes</a>
            </form>
        </div>
    </div>
</main>



      <!-- Footer -->
  <footer class="footer">
    <div class="container">
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
