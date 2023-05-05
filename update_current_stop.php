<?php
// Connection information
include 'config.php';

// Check if the user is logged in and has the correct user_type
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "driver") {
    header("Location: login.php");
    exit();
}

// Get the new current stop ID from the POST data
$current_stop_id = $_POST["current_stop_id"];

// Prepare the SQL statement to update the driver's current stop
$sql = "UPDATE users SET current_stop_id = ? WHERE id = ?";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("ii", $current_stop_id, $_SESSION["user_id"]);

// Execute the query
if ($stmt->execute()) {
    // Redirect the user back to the driver dashboard
    header("Location: driver_dashboard.php");
    exit();
} else {
    // Handle any errors that occurred during the query execution
    echo "Error updating current stop: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$db_connection->close();
?>

