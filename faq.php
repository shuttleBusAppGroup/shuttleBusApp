<?php
include_once 'config.php';
?>

<!DOCTYPE html>
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
    <script src="/js/admin_scripts.js"></script>

    </head>
    <body>


    <!-- Header -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="faq.php">FAQs</a>
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
    <!-- Main Section of Admin Page -->
        <main role="main">
            <div class="container">
                <table>
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
</main>



</body>
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
</html>

