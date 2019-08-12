<?php 
    require_once('core/init.php');

    $tweet = $_GET['tweet'];
    $user_id = $_GET['user_id'];

    $query = "UPDATE tweet SET text='$tweet' WHERE user_id='$user_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error());

    header('Location: index.php');
?>