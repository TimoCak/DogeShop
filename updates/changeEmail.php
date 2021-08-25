<?php

include "../includes/functions.inc.php";

session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

$id = $_SESSION["userid"];

$newEmail = $_POST["email"];

$stmt = $connection->prepare("UPDATE users SET usersEmail=? WHERE usersId=?");

$stmt->bind_param("si",$newEmail,$id);

if (invalidEmail($newEmail) !== false ) {
    $connection->close();
    header("Location: ../profile.php?successEmail=0");
} else if (emailExists($connection,$newEmail) !== false) {
    $connection->close();
    header("Location: ../profile.php?successEmail=taken");
}
else {
    $stmt->execute();
    $stmt->close();
    $connection->close();
    header("Location: ../profile.php?successEmail=1");
}


