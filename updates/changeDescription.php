<?php
session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

if (isset($_POST["submit"])) {
    $stmt = $connection->prepare("UPDATE information SET description=? WHERE productId=?");

    $id = $_POST["submit"];

    $newDescription = $_POST["changeDescription"];

    $stmt->bind_param("si",$newDescription,$id);

    $stmt->execute();

    $stmt->close();
}

$connection->close();

header("Location: ../myProducts.php");