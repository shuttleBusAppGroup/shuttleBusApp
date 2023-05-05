<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Privacy Policy</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">


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
                <a class="navbar-brand" href="about.php">About us</a>
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
    <p>Last updated: 05/05/2023</p>
    <h4>This Privacy Policy explains how (Your Company Name) ("we", "us", or "our") collects, uses, shares, and protects your information when you visit our website (Your Website URL). By using our website, you agree to the collection and use of information in accordance with this Privacy Policy.</h4>
    
    <h2>Information Collection and Use</h2>
    <p>While using our website, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. This may include, but is not limited to, your name, email address, and phone number.</p>

    <h2>Log Data</h2>
    <p>When you visit our website, our servers may automatically collect information about your computer's Internet Protocol (IP) address, browser type, browser version, the pages you visit on our site, the time and date of your visit, and other statistics.</p>

    <h2>Cookies</h2>
    <p>We may use cookies to collect information about your visit to our website. Cookies are small files that a website or its service provider transfers to your computer's hard drive through your web browser (if you allow) to enable the site's systems to recognize your browser and capture certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>

    <h2>Security</h2>
    <p>The security of your personal information is important to us, but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to protect your personal information, we cannot guarantee its absolute security.</p>

    <h2>Links to Other Sites</h2>
    <p>Our website may contain links to other sites that are not operated by us. If you click on a third-party link, you will be directed to that third party's site. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>

    <h2>Changes to This Privacy Policy</h2>
    <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. You are advised to review this Privacy Policy periodically for any changes.</p>

    <p>If you have any questions about this Privacy Policy, please contact us at (Your Contact Information).</p>
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

</body>

</html>