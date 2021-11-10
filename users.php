<?php
include "html_Files/navbar.php";
include "Connector/db_connect.php";

$dbh = $_SESSION['dbh'];

$res = $dbh->query("SELECT * FROM users");

if ($res->num_rows > 0) {
    while($i = $res->fetch_assoc()) {
        echo "<div class='users'><a href='user.php?userid=".$i['usersId']."'><h2>".$i['usersUid']."</h2></a>";
        if ($i['usersPicture']==null) {
            echo "<img width='200' height='200' src='Pictures/doge-vector-illustration.png'>";
        } else {
            echo "<img class='profilePic' width='200' height='200' src='".$i['usersPicture']."'></div>";
        }

    }
}

$dbh->close();
?>

<style>
    body {
        text-align: center;
    }
    .users {
        border-style: solid;
        border-width: 2px;
    }
    .profilePic {
        margin-bottom: 2em;
    }


</style>


















<?php
include "html_Files/footer.php";
?>
