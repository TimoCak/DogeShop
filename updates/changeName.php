<?php
session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

$id = $_SESSION["userid"];

$changedTitle = $_POST["name"];

$url = "../profile.php";

$stmt = $connection->prepare("UPDATE users SET usersName=? WHERE usersId=?");

$stmt->bind_param("si",$changedTitle,$id);

if ($changedTitle != "") {
    //$update = $connection->query("UPDATE users SET usersName='$changedTitle' WHERE usersId='$id'");
    $stmt->execute();
    $stmt->close();
    $url = $url . "?successName=1";
} else {
    $url = $url . "?successName=0";
}
$connection->close();

header("Location: $url");


