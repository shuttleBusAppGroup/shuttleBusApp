<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Connection information
include 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "driver") {
    header("Location: login.php");
    exit();
}


// Prepare the SQL statement to get the driver's route information
$sql = "SELECT * FROM routes WHERE id = ?";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("i", $_SESSION["user_id"]);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch the driver's route data
$route = $result->fetch_assoc();

// Close statement and connection
$stmt->close();
$db_connection->close();
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
    <title>Driver Dashboard - Shuttle Bus App</title>
</head>
<body>
          <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Home</a>
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
<!-- end Nav bar -->


    <!-- Main content -->
    <main role="main" class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome, <?php echo $_SESSION["username"]; ?></h1>
                <h2 class="mt-4">Current Route Information</h2>
                <?php if ($route): ?>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Route ID</th>
                            <td><?php echo $route["id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Current Stop</th>
                            <td><?php echo $route["current_stop"]; ?></td>
                        </tr>
                        <tr>
                            <th>Next Stop</th>
                            <td><?php echo $route["next_stop"]; ?></td>
                        </tr>
                        <tr>
                            <th>Time to Next Stop</th>
                            <td><?php echo $route["current_time_stamp"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No route assigned.</p>
                <?php endif; ?>
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
