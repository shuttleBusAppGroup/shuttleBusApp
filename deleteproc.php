<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'config.php';

// Check if the user is logged in and has the correct user_type
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "admin") {
	header("Location: index.php");
	exit();
}

$sql = "DELETE FROM routes WHERE id='" . $_GET["id"] . "'";

if (mysqli_query($db_connection, $sql)) {
    header('Location:admin_dashboard.php');
	exit;
} else {
    echo "Error deleting route: " . mysqli_error($db_connection);
}

mysqli_close($db_connection);
?>
<!DOCTYPE html>
<html>
    <body>
        <br>
        <a href="admin_dashboard.php">Go Back to List</a>
    </body>
</html>
