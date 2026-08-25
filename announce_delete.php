<?php
session_start();

include_once 'config.php';
$sql = "DELETE FROM announcements WHERE announce_id='" . $_GET["announce_id"] . "'";


if (mysqli_query($db_connection, $sql)) {
	
    header('Location:announcements.php');
	exit;
} else {
    error_log('Announcement deletion failed.');
    echo "Unable to delete the announcement.";
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
