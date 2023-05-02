<?php
require_once "config.php";

function addShuttlePosition($shuttle_id, $latitude, $longitude) {
  global $db_connection;

  $stmt = $db_connection->prepare("INSERT INTO shuttle_positions (shuttle_id, latitude, longitude) VALUES (?, ?, ?)");
  $stmt->bind_param("idd", $shuttle_id, $latitude, $longitude);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

  $stmt->close();
}

function updateShuttlePosition($shuttle_id, $latitude, $longitude) {
  global $db_connection;

  $stmt = $db_connection->prepare("UPDATE shuttle_positions SET latitude = ?, longitude = ? WHERE shuttle_id = ?");
  $stmt->bind_param("ddi", $latitude, $longitude, $shuttle_id);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

  $stmt->close();
}

function getShuttlePosition($shuttle_id) {
  global $db_connection;

  $stmt = $db_connection->prepare("SELECT latitude, longitude FROM shuttle_positions WHERE shuttle_id = ?");
  $stmt->bind_param("i", $shuttle_id);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $position = $result->fetch_assoc();
    return $position;
  } else {
    return false;
  }

  $stmt->close();
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$shuttlePositions = getAllShuttlePositions();
echo json_encode($shuttlePositions);

function getAllShuttlePositions() {
  global $db_connection;

  $stmt = $db_connection->prepare("SELECT * FROM shuttle_positions");
  $stmt->execute();

  $result = $stmt->get_result();
  $positions = $result->fetch_all(MYSQLI_ASSOC);
  return $positions;

  $stmt->close();
}

?>

