<style>

</style>

<?php
if (!isset($_SESSION["userid"])) {
    session_start();
}


if (file_exists("../includes/functions.inc.php")) {
include "../includes/functions.inc.php";
}
#select history

if (isset($_GET["id"])&&isUserInChat($_GET["id"])) {

    $res = selectHistory($_GET["id"]);

    echo "<p>SAY HELLO!</p><p>------------------------</p><br>";

    if ($res != null) {
        while ($row = $res->fetch_assoc()) {

            if ($row["userId"] == $_SESSION["userid"]) {
                echo "<span style='color: dodgerblue'>" . giveUsername($row["userId"]) . "</span>: " . $row['message'];
                echo "<br>";
            } else {
                echo "<span style='color: red'>" . giveUsername($row["userId"]) . "</span>: " . $row['message'];
                echo "<br>";
            }

        }
    }


}
?>


