<?php

include "../includes/functions.inc.php";

deleteChat($_POST["deleteChat"]);

header("Location: ../myChat.php");
exit();