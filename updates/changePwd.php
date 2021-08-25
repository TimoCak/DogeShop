<?php
include "../includes/functions.inc.php";

session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);



$pwd = $_POST["pwd"];
$rePwd = $_POST["repwd"];
$hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

$id = $_SESSION["userid"];

$stmt = $connection->prepare("UPDATE users SET usersPwd=? WHERE usersId=?");

$stmt->bind_param("si",$hashedPwd,$id);

if (pwdMatch($pwd,$rePwd) !== false) {
    $connection->close();
    header("Location: ../profile.php?successPwd=0");
} else {
    $stmt->execute();
    $stmt->close();
    $connection->close();
    header("Location: ../profile.php?successPwd=1");
}


