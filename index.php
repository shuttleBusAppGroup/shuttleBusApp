<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>University Shuttle Bus App</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Custom CSS -->
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
        </ul>
      </div>
    </div>
  </nav>


  <!-- Hero section -->
  <section class="jumbotron">
    <br>
    <h1 class="display-4 text-white">⏰ Welcome to the University Shuttle Bus App 🚎</h1>
    <br>
    <h5>Get around campus with ease. Find the nearest shuttle bus stop, get real-time schedules, and track your bus in
      real-time.</h5>
    <h6>More updates to functionality coming soon. Please check back again soon. 👷🏾‍♀️🚧👷🏻</h6>
    <br>
  </section>
  
  <div class="wrapper">
    <!-- Main content -->
    <main role="main">
    <br>
    <!-- Login section -->
    <section class="container">
    <div class="form-container border p-4">
        <h2 class="text-center">Log in</h2>
        <form method="POST" action="/authenticate.php">
        <div class="form-group">
            <label for="email">Email &nbsp;&nbsp;</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <br>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <br>
        <div class="text-center">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary d-inline-block mb-2 mr-md-2">Login</button>
            </div>
            <div class="col-md-6">
                <a href="./registration.php" class="btn btn-success d-inline-block mb-2">Register</a>
            </div>
            </div>
        </div>
        </form>
    </div>
    </section>
    </main>

        <!-- Footer -->
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