<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include_once 'config.php';
$sql = "DELETE FROM announcements WHERE announce_id='" . $_GET["announce_id"] . "'";


if (mysqli_query($db_connection, $sql)) {
	
    header('Location:announcements.php');
	exit;
} else {
    echo "Error deleting route: " . mysqli_error($db_connection);
?>
<html>
<body>
<br>
<a href="announcements.php">Go Back to List</a>
</body>
</html>
<?php
}

mysqli_close($db_connection);
?>
