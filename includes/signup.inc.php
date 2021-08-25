<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    include 'functions.inc.php';

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $dbh = mysqli_connect($servername,$user,$pass,$db_name);

    if(!$dbh) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (emptyInputSignup($name,$email,$username,$pwd,$pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd,$pwdRepeat) !== false) {
        header("location: ../signup.php?error=nopwdmatch");
        exit();
    }
    if (uidExists($dbh,$username,$email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($dbh,$name,$email,$username,$pwd);

} else {
    header("location: ../signup.php");
    exit();
}

