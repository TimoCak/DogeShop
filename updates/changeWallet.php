<?php
session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);


if (isset($_SESSION["userid"])&&isset($_POST["submit"])&&isset($_POST["wallet"])) {

    $stmt = $connection->prepare("UPDATE information SET wallet=? WHERE productId=?");

    $id = $_POST["submit"];

    $changedWallet = $_POST["wallet"];

    $stmt->bind_param("si", $changedWallet, $id);
    $stmt->execute();
    $stmt->close();

}

$connection->close();

header("Location: ../myProducts.php");
