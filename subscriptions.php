<?php
require_once "config.php";

function addSubscription($user_id, $subscription_type, $expiry_date) {
  global $db_connection;

  $stmt = $db_connection->prepare("INSERT INTO subscriptions (user_id, subscription_type, expiry_date) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $user_id, $subscription_type, $expiry_date);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

  $stmt->close();
}

function deleteSubscription($subscription_id) {
  global $db_connection;

  $stmt = $db_connection->prepare("DELETE FROM subscriptions WHERE id = ?");
  $stmt->bind_param("i", $subscription_id);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

  $stmt->close();
}

function modifySubscription($subscription_id, $subscription_type, $expiry_date) {
  global $db_connection;

  $stmt = $db_connection->prepare("UPDATE subscriptions SET subscription_type = ?, expiry_date = ? WHERE id = ?");
  $stmt->bind_param("ssi", $subscription_type, $expiry_date, $subscription_id);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

  $stmt->close();
}

function viewUserSubscriptions($user_id) {
  global $db_connection;

  $stmt = $db_connection->prepare("SELECT id, subscription_type, expiry_date FROM subscriptions WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $subscriptions = $result->fetch_all(MYSQLI_ASSOC);
    return $subscriptions;
  } else {
    return false;
  }

  $stmt->close();
}
?>

