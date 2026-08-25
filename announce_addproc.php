<?php
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
        error_log('Announcement creation failed.');
        echo "Unable to create the announcement.";
    }
    mysqli_close($db_connection);
}
?>
