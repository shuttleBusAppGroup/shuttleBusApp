<?php
include 'config.php';
?>

<!DOCTYPE html>
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
    <title>FAQs - Shuttle Bus App</title>
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

  <br><br>
    <div class="table-responsive">
  <table class="table">
    <tbody>
      <tr>
        <th>What is the Shuttle Bus App?</th>
        <td>The Shuttle Bus App is a mobile application designed to provide students and faculty members with information about shuttle bus routes and schedules.</td>
      </tr>
      <tr>
        <th>How do I download the Shuttle Bus App?</th>
        <td>The Shuttle Bus App can be downloaded from the App Store or Google Play Store on your mobile device.</td>
      </tr>
      <tr>
        <th>How do I use the Shuttle Bus App?</th>
        <td>Once you've downloaded and installed the Shuttle Bus App, you can open the app to view shuttle bus routes and schedules. You can also use the app to track the location of shuttle buses in real time.</td>
      </tr>
      <tr>
        <th>Are there any fees associated with using the Shuttle Bus App?</th>
        <td>No, the Shuttle Bus App is free to download and use.</td>
      </tr>
      <tr>
        <th>What if I have a question or problem with the Shuttle Bus App?</th>
        <td>If you have any questions or problems with the Shuttle Bus App, you can contact the app support team at support@shuttlebusapp.com.</td>
      </tr>
      <tr>
        <th>How often are shuttle bus routes and schedules updated?</th>
        <td>Shuttle bus routes and schedules are updated regularly to ensure accuracy and reliability. Any changes to shuttle bus routes or schedules will be reflected in the Shuttle Bus App as soon as possible.</td>
      </tr>
      <tr>
        <th>Is the Shuttle Bus App available for all shuttle bus routes?</th>
        <td>The Shuttle Bus App is currently available for most shuttle bus routes. If your shuttle bus route is not currently supported by the app, please contact the shuttle bus office for more information.</td>
      </tr>
    </tbody>
  </table>
</div>



</body>
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
</html>

