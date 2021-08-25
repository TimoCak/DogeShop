<?php

session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

if (isset($_POST["delete"])) {

    $productId = $_POST["delete"];

    $stmt = $connection->prepare("DELETE FROM information WHERE productId=?");

    $stmt->bind_param("i", $productId);



    $stmt->execute();

    $stmt->close();
}

$connection->close();

header("Location: ../myProducts.php");

?>

