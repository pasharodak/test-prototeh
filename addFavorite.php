<?php
    
    $user = $_COOKIE["login"];
    $mysqli = new mysqli("localhost", "root", "","prototeh");
    $mysqli->query("SET NAMES 'utf8'");
    $result_set = $mysqli-> query("SELECT * FROM `users` where `login` = '$user';");
    $result1 = $result_set->fetch_assoc();
    $favorite = $result1['favorite'];
    $id = $_POST["send"];
    $add = $favorite.",".$id;
    $result_set = $mysqli-> query("UPDATE `users` SET `favorite` = '$add' where `login` = '$user';");
    $mysqli->close();
    header("Location: /index.php");
    exit;
?>
