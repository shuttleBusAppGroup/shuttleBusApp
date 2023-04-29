<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Shuttle Bus App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faq.php">FAQs</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1 class="mt-5 mb-3">About Us</h1>
    <p>The Shuttle Bus App is a convenient transportation solution for university students, faculty, and staff. Our mission is to provide a reliable and efficient shuttle bus service that helps our users get to their destinations on time.</p>
    <p>Our fleet of modern, eco-friendly buses is equipped with comfortable seating, free Wi-Fi, and GPS tracking to ensure a smooth and pleasant ride. Our professional and experienced drivers are dedicated to maintaining the highest standards of safety and customer service.</p>
    <p>The Shuttle Bus App allows users to view real-time bus schedules, find nearby bus stops, and receive important updates about route changes and delays. With the user-friendly interface and advanced features, planning your daily commute has never been easier!</p>
  </div>

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
