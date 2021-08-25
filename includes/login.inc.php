<?php

if (isset($_POST["submit"])) {

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "functions.inc.php";

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $dbh = mysqli_connect($servername,$user,$pass,$db_name);

    if(!$dbh) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (emptyInputLogin($username,$pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    loginUser($dbh, $username, $pwd);
} else {
    header("location: ../login.php");
    exit();
}