<?php

include_once 'config.php';
$sql = "DELETE FROM routes WHERE id='" . $_GET["id"] . "'";


if (mysqli_query($conn, $sql)) {
	
    header('Location:retrieve.php');
	exit;
} else {
    echo "Error deleting route: " . mysqli_error($conn);
?>
<html>
<body>
<br>
<a href="retrieve.php">Go Back to List</a>
</body>
</html>
<?php
}

mysqli_close($conn);
?>
