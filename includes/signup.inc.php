<?php

include "../PHPMailer/src/PHPMailer.php";
include "../PHPMailer/src/SMTP.php";
include "../PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'dogeshop8@gmail.com';                     //SMTP username
        $mail->Password = 't7i9m8o12';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;               //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('no-reply@sellfordoge.com', 'sellfordoge.com');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Welcome '.$username.'to sellfordoge.com!';
        $mail->Body = "Please join the community and begin to sell(buy) products for dogecoin! <a href='https://sellfordoge.com'>sellfordoge.com</a>";
        $mail->AltBody = 'Please join the community and begin to sell(buy) products for dogecoin! Visit: https://sellfordoge.com';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    createUser($dbh,$name,$email,$username,$pwd);


} else {
    header("location: ../signup.php");
    exit();
}

