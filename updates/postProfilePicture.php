<?php
session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);



if (isset($_POST["submit"])) {

    $picture =  "upload/".$_SESSION["userid"]."/".basename($_FILES['profilePicture']['name']);

    echo $picture;

    $stmt = $connection->prepare("UPDATE users SET usersPicture=? WHERE usersId=?");

    $id = $_SESSION["userid"];

    $stmt->bind_param("si",$picture,$id);

    $stmt->execute();

    if ($_FILES["profilePicture"]["error"] > 0) {
        echo "Error: " . $_FILES["profilePicture"]["error"] . "<br>";
    } else {
        move_uploaded_file($_FILES["profilePicture"]["tmp_name"],
            "../upload/".$_SESSION["userid"]."/". $_FILES["profilePicture"]["name"]);
    }

    $stmt->close();
}

$connection->close();

header("Location: ../profile.php");