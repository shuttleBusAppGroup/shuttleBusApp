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
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $route_id = $_POST['route_id'];
    $bus_name = $_POST['bus_number'];
    $stop_name = $_POST['stop_name'];
    $route_name = $_POST['route_name'];
    $arrival_time = $_POST['arrival_time'];

    // Insert the bus_name into the buses table if it doesn't exist
    $bus_query = "INSERT IGNORE INTO buses (bus_number) VALUES (?)";
    $stmt = $db_connection->prepare($bus_query);
    $stmt->bind_param("s", $bus_name);
    $stmt->execute();

    // Insert the stop_name into the stops table if it doesn't exist
    $stop_query = "INSERT IGNORE INTO stops (stop_name) VALUES (?)";
    $stmt = $db_connection->prepare($stop_query);
    $stmt->bind_param("s", $stop_name);
    $stmt->execute();

    // Get the bus_id and stop_id from the buses and stops tables using the bus_name and stop_name
    $bus_query = "SELECT id FROM buses WHERE bus_number = ?";
    $stmt = $db_connection->prepare($bus_query);
    $stmt->bind_param("s", $bus_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
    }

    $stop_query = "SELECT stop_id FROM stops WHERE stop_name = ?";
    $stmt = $db_connection->prepare($stop_query);
    $stmt->bind_param("s", $stop_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stop_id = $row["stop_id"];

    $route_query = "SELECT route_id FROM routes WHERE route_id = ?";
    $stmt = $db_connection->prepare($route_query);
    $stmt->bind_param("i", $route_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $route_insert_query = "INSERT INTO routes (route_id, route_name, origin, destination) VALUES (?, ?, ?, ?)";
        $stmt = $db_connection->prepare($route_insert_query);
        $stmt->bind_param("isss", $route_id, $route_name, $origin, $destination);
        $stmt->execute();

    }



    // Check if $route_id is empty, if so, generate an AUTO_INCREMENT value
    if (empty($route_id)) {
        $sql = "INSERT INTO route_stops (id, stop_id, arrival_time)
                VALUES (?, ?, ?)";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("iis", $id, $stop_id, $arrival_time);
    } else {
        $sql = "INSERT INTO route_stops (id, route_id, stop_id, arrival_time)
                VALUES (?, ?, ?, ?)";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("iiis", $id, $route_id, $stop_id, $arrival_time);
    }

    if ($stmt->execute()) {
        echo "New route created successfully!";
        header('Location: admin_dashboard.php');
        exit();
    } else {
        if (empty($stop_id)) {
            echo "Error: stop_id cannot be retrieved. Check if the stop_name exists in the route_stops table.";
        } else {
            echo "Error: " . $sql . " " . $stmt->error;
        }
        exit();
    }
}

mysqli_close($db_connection);

?>
