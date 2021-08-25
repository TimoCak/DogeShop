<?php
include "../includes/functions.inc.php";

session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

$id = $_SESSION["userid"];

$newUid = $_POST["uid"];

$stmt = $connection->prepare("UPDATE users SET usersUid=? WHERE usersId=?");

$stmt->bind_param("si",$newUid,$id);

if (invalidUid($newUid) !== false) {
    $connection->close();
    header("Location: ../profile.php?successUid=0");
} else if (usernameExists($connection,$newUid)) {
    $connection->close();
    header("Location: ../profile.php?successUid=taken");
}
else {
    $stmt->execute();
    $stmt->close();
    $connection->close();
    header("Location: ../profile.php?successUid=1");
}