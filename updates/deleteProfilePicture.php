<?php

session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername, $user, $pass, $db_name);


if (isset($_POST["delete"])) {

    $picture = null;

    $stmt = $connection->prepare("UPDATE users SET usersPicture=? WHERE usersId=?");


    $stmt->bind_param("si", $picture, $_SESSION["userid"]);


    $stmt->execute();


    $stmt->close();
}

$connection->close();

header("Location: ../profile.php");