<?php
include "../includes/functions.inc.php";
session_start();

postMessage($_POST["send"],$_SESSION["userid"],$_POST["message"]);

header("Location: ../myChat.php?id=".$_POST["send"]);
exit();