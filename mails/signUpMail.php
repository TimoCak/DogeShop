<?php


include "../PHPMailer/src/PHPMailer.php";
include "../PHPMailer/src/SMTP.php";
include "../PHPMailer/src/Exception.php";
include "../includes/functions.inc.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);
$seller = $_POST["seller"];
$buyer = $_POST["buyer"];
$pid = $_POST["pid"];

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
    $mail->setFrom('no-reply@dogeshop.xyz', 'Doge Shop');
    $mail->addAddress('timocaktu@gmail.com', 'Timo Caktu');     //Add a recipient
    #$mail->addAddress('ellen@example.com');               //Name is optional
    #$mail->addReplyTo('info@example.com', 'Information');
    #$mail->addCC('cc@example.com');
    #$mail->addBCC('bcc@example.com');

    //Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Welcome'.$username.'to sellfordoge.com!';
    $mail->Body = "Please join the community and begin to sell(buy) products for dogecoin! <a href='https://sellfordoge.com'>sellfordoge.com</a>";
    $mail->AltBody = 'Please join the community and begin to sell(buy) products for dogecoin! Visit: https://sellfordoge.com';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


