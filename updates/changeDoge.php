<?php
session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

if (isset($_POST["submit"])) {
    $stmt = $connection->prepare("UPDATE information SET price=? WHERE productId=?");

    $id = $_POST["submit"];

    $newPrice = $_POST["changeDoge"];

    $stmt->bind_param("di",$newPrice,$id);

    $stmt->execute();

    $stmt->close();
}

$connection->close();

header("Location: ../myProducts.php");