<?php
    require_once('core/init.php');

    $user_id = $_GET['user_id'];
    $query = "DELETE FROM tweet WHERE user_id='$user_id'";
    $result = mysqli_query($link, $query) or die("gagal delete");
    header('Location: index.php');
?>