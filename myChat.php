<?php
include "html_Files/navbar.php";
include "html_Files/particles.php";
?>
<style>
    body {
        text-align: center;
        overflow-x: hidden;
    }
    #personal {
        text-decoration: none;
        background-color: grey;
        color: white

    }
    #personal:hover {
        background-color: #1e4151;
        color: #c2bd60;
    }

</style>



<br><br>
<h1 style="display: inline;margin-right: 10px;" ><a href="profile.php" id="personal">Personal Info</a></h1>
<h1 style="display: inline;margin-right: 10px;"><a href="myProducts.php" id="personal">MyProducts</a></h1>
<h1 style="display: inline; background-color: #1e4151; color: #c2bd60;margin-right: 10px">MyChats</h1>
<br>

<?php
    if(isset($_GET["id"])) {
        $servername = "localhost";
        $db_name = "products";
        $user = "root";
        $pass = "t7i9m8o12";

        $connection = new mysqli($servername,$user,$pass,$db_name);

        $chatId = $_GET["id"];


        #create history
        $stmt = $connection->query("CREATE TABLE history".$chatId." IF NOT EXISTS (messageId int NOT NULL AUTO_INCREMENT,
        userId int, message varchar(255), PRIMARY KEY (messageId));");

        $connection->close();
    }
?>




<?php
include "html_Files/toggleNight.php";
include "html_Files/footer.php";
?>


















