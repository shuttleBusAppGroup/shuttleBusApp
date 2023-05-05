<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once 'config.php';
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $addedOn = date("Y-m-d H:i:s");
    $deleteOn = !empty($_POST['deleteOn']) ? $_POST['deleteOn'] : null;
    $sql = "INSERT INTO announcements (title,message,addedOn,deleteOn)
	VALUES ('$title','$message','$addedOn','$deleteOn')";
    if (mysqli_query($db_connection, $sql)) {
        echo "New announcement created successfully !";
        header('Location:announcements.php');
        exit;
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($db_connection);
    }
    mysqli_close($db_connection);
}
?>