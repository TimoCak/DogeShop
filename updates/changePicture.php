<?php
session_start();

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);



if (isset($_POST["submit"])) {

    $picture =  "upload/".$_SESSION["userid"]."/".basename($_FILES['picture']['name']);

    $stmt = $connection->prepare("UPDATE information SET picture=? WHERE productId=?");

    $id = $_POST["submit"];

    $stmt->bind_param("si",$picture,$id);

    $stmt->execute();

    if ($_FILES["picture"]["error"] > 0) {
        echo "Error: " . $_FILES["picture"]["error"] . "<br>";
    } else {
        move_uploaded_file($_FILES["picture"]["tmp_name"],
            "../upload/".$_SESSION["userid"]."/". $_FILES["picture"]["name"]);
    }

    $stmt->close();
}

$connection->close();

header("Location: ../myProducts.php");
