<?php
include "html_Files/navbar.php";
include "Connector/db_connect.php";

if(isset($_GET["userid"])) {
    $dbh = $_SESSION['dbh'];
    $id = $_GET["userid"];
    $query = $dbh->query("SELECT * FROM users WHERE usersId=$id");

    if ($query->num_rows > 0){
        while ($i = $query->fetch_assoc()) {
            echo $i["usersUid"];
        }
    }

}


?>

<style>

</style>

























<?php
include "html_Files/footer.php";

?>