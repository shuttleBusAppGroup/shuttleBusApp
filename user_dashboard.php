<?php

include 'config.php';
session_start();

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "user") {
    header("Location: index.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
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
    <p>Welcome, <?php echo $_SESSION["username"]; ?></p>


<?php

  // The rest of your restricted page content goes here
  echo "<div class='container'>";
  echo "<h2 class='mt-5 mb-3 text-center'>Shuttle Bus Routes</h2>";

  $result = $db_connection->query("SELECT * FROM routes");

  // Column names
  $columnNames = array('Route ID', 'Route Name', 'Bus Number', 'Current Stop', 'Next Stop', 'Current Time', 'Time to Next Stop');

  // Display table header
  echo "<table class='table table-striped table-responsive-sm'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  foreach ($columnNames as $columnName) {
      echo "<th scope='col'>" . $columnName . "</th>";
  }
  echo "</tr>";
  echo "</thead>";

  // Display table rows
  echo "<tbody>";
  while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["route_id"] . "</td>";
      echo "<td>" . $row["route_name"] . "</td>";
      echo "<td>" . $row["bus_number"] . "</td>";
      echo "<td>" . $row["current_stop"] . "</td>";
      echo "<td>" . $row["next_stop"] . "</td>";
      echo "<td>" . $row["current_time_stamp"] . "</td>";
      echo "<td>" . $row["time_to_next_stop"] . " minutes</td>";
      echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";

    // Close the connection
  $db_connection->close();
  ?>
</body>
</html>