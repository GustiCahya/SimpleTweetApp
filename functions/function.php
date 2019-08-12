<?php

function read($table){
    global $link;
    $query = "SELECT * FROM $table";
    if($result = mysqli_query($link, $query) or die("gagal menampilkan data")) return $result;
}

function insertToUsers($name, $email){
    global $link;
    $query = "INSERT INTO users(name, email) VALUES ('$name', '$email')";
    if(mysqli_query($link, $query)) return true;
    else return false;
}

function insertToTweet($tweet,$user_id){
    global $link;
    $query = "INSERT INTO tweet(text,user_id) VALUES ('$tweet','$user_id')";
    if(mysqli_query($link, $query)) return true;
    return false;
}


?>