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

if (isset($_POST['save'])) {
    $route_id = $_POST['route_id'];
    $route_name = $_POST['route_name'];
    $current_stop = $_POST['current_stop'];
    $next_stop = $_POST['next_stop'];
    $bus_id = $_POST['bus_id'];
    $time_to_next_stop = $_POST['time_to_next_stop'];
    $sql = "INSERT INTO routes (route_id,route_name,current_stop,next_stop,bus_id,time_to_next_stop)
    VALUES ('$route_id','$route_name','$current_stop','$next_stop','$bus_id','$time_to_next_stop')";
    if (mysqli_query($db_connection, $sql)) {
        echo "New route created successfully !";
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($db_connection);
    }
    mysqli_close($db_connection);
}
?>
