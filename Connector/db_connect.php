<?php

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$dbh = mysqli_connect($servername,$user,$pass,$db_name);

if(!$dbh) {
    die("Connection failed: " . mysqli_connect_error());
}

$_SESSION['dbh'] = $dbh;



