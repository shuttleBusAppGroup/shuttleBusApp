<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

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
    <script src="/js/admin_scripts.js"></script>
  
</head>


<body>
    <!-- Header -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">University Shuttle Bus App</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="faq.php">FAQs</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Main content -->


    <main role="main">
    <div class="container">
    <div class="jumbotron">

    <h1 class="display-4 text-white">⏰ Welcome to the University Shuttle Bus App 🚎</h1>
    <br>
    <h4>Get around campus with ease. Find the nearest shuttle bus stop, get real-time schedules, and track your bus in real-time.</h4>
    <h4>More updates to functionality coming soon. Please check back again soon. 👷🏾‍♀️🚧👷🏻</h4>
    <br>
    </div>
    <!-- Login section -->
    <h2 class="text-center">Log in</h2>
    <div class="form-container">
        <form class="form-group" method="POST" action="/authenticate.php">
            <label for="email">Email &nbsp;&nbsp;</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        <br>
        <br>
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
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
    </div>
        </form>
    </div>
</main>

<!-- Footer -->
<footer class="bg-darker text-center text-white container">
    <div class="footer-copyright text-center py-3">
        <!-- Footer links -->
        <a href="privacy-policy.php">Privacy Policy</a> &middot; <a href="terms-of-service.php">Terms of Service</a>
        &nbsp;&copy;
        <?php echo date("Y"); ?> University Shuttle Bus App. All Rights Reserved.
    </div>
</footer>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>