<?php
include "html_Files/navbar.php";
include "Connector/db_connect.php";

$dbh = $_SESSION['dbh'];

$res = $dbh->query("SELECT * FROM users");

if ($res->num_rows > 0) {
    while($i = $res->fetch_assoc()) {
        echo "<a href='#'><h2>".$i['usersUid']."</h2></a>";
    }
}

$dbh->close();
?>


















<?php
include "html_Files/footer.php";
?>
