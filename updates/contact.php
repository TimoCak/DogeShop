<?php
include "../includes/functions.inc.php";

session_start();

if (isset($_SESSION["userid"])&&duplicateChat($_SESSION["userid"],$_POST["submit"])==false) {

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);

    $user2 = $_POST["submit"];

    #create chat
    $stmt = $connection->prepare("INSERT INTO chats (user1, user2) VALUES (?,?)");

    $stmt->bind_param("ii",$_SESSION["userid"], $user2);

    $stmt->execute();

    $stmt->close();

    #create chatHistory
    $stmt1 = $connection->prepare("SELECT chatId FROM chats WHERE user1=? AND user2=? LIMIT 1");

    $stmt1->bind_param("ii",$_SESSION["userid"],$user2);

    $stmt1->execute();

    $res = $stmt1->fetch();

    $stmt1->close();

    $connection->close();

    header("Location: ../myChat.php?id=".$res);
}
else {
    header("Location: ../login.php");
    exit();
}