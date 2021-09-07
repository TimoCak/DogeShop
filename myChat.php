<?php
include "html_Files/navbar.php";
include "html_Files/particles.php";
?>

<head>
    <title>myChats</title>
</head>

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
    #chats {
        border-style: solid;
        display: block;
        position: fixed;
        left: 0%;
        top: 25%;
        height: 50%;
        background-color: white;
        overflow-y: scroll;
    }
    @media only screen and (max-width: 700px) {
        #chats {
            margin: unset;
            padding: unset;
        }

    }
    .users {
        border-style: solid;
        padding: 1em;
    }
    .users:hover {
        background-color: #1e4151;
        color: #c2bd60;
    }
    #deleteChat {
        border-style: solid;
        border-color: #111111;
        background-color: #111111;
    }
    #chatLink {
        text-decoration: none;
        color: #c2bd60;
    }
    #chatLink:hover {
        color: #c2bd60;
    }
    #chatPrint {
        width: 50%;
        height: 500px;
        background-color: white;
        margin-left: auto;
        margin-right: auto;
        border-style: groove;
        display: block;
        overflow-y: scroll;

    }

    #postMessage {
        display: block;
        margin: auto;
        border-style: groove;
        width: 50%;
        background-color: #1e4151;
    }
    #message {
        width: 100%;

    }
    #send {
        width: 100%;
    }
    #profilePicture {
        width: 50px;
        height: 50px;
    }
    .users.card {
        display: block;
    }
    .list-group-item {
        width: 150px;
    }


</style>
<?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        echo "<body id='data' onload='selectChat($id)'>";
    } else {
        echo "<body id='data'>";
    }

?>
<br><br>
<h1 style="display: inline;margin-right: 10px;" ><a href="profile.php" id="personal">Personal Info</a></h1>
<h1 style="display: inline;margin-right: 10px;"><a href="myProducts.php" id="personal">MyProducts</a></h1>
<h1 style="display: inline; background-color: #1e4151; color: #c2bd60;margin-right: 10px">MyChats</h1>
<br><br>

<?php

    include "includes/functions.inc.php";

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);



if(isset($_GET["id"])) {

    $chatId = $_GET["id"];
    #create history
    if (isUserInChat($chatId)) {
        $stmt = $connection->query("CREATE TABLE history" . $_GET["id"] . "(messageId int NOT NULL AUTO_INCREMENT,
        userId int, message varchar(255), PRIMARY KEY (messageId));");
    }
}

    echo "<div id='chatPrint' readonly class='form-text'> ";

    $stmt2 = $connection->prepare("SELECT * FROM chats WHERE user1=? OR user2=?");

    $stmt2->bind_param("ii", $_SESSION["userid"], $_SESSION["userid"]);

    $stmt2->execute();

    $stmt2->bind_result($chatid, $user1, $user2);

    include "html_Files/chat.php";

        if (isset($_GET["id"])&&isUserInChat($_GET["id"])) {
                echo "</div><br><br><form  method='post' action='updates/postMessage.php' id='postMessage'><textarea class='form-control' name='message' id='message' type='textarea' rows='4' placeholder='...'></textarea>
                    <button id='send' class='btn btn-primary' name='send' type='submit' value=" . $_GET["id"] . ">send</button></form> </div>";
        }
        echo "<ul class='list-group' id='chats'><tr ><th style='border-style: groove; border-color: #111111'><li class='list-group-item'>CHATS</li>";
        while ($stmt2->fetch()) {
            echo "<li class='list-group-item'>";
            if ($user1 == $_SESSION["userid"]) {
                echo "<a  id='chatLink' href='myChat.php?id=$chatid' ><div class='users card' id='$chatid'>
                  <span class='card-title'>" . giveUsername($user2) . "</span>";
                if (getProfilePicture($user2) != null) {
                    echo "<img class='card-img-top' id='profilePicture' src='" . getProfilePicture($user2) . "'>";
                } else {
                    echo "<img class='card-img-top' id='profilePicture' src='Pictures/doge-vector-illustration.png'>";
                }
                echo "</div></a>";
            } else {
                echo "<a  id='chatLink' href='myChat.php?id=$chatid' ><div class='users card' id='$chatid'>
                <span class='card-title'>" . giveUsername($user1) . "</span>";

                if (getProfilePicture($user1) != null) {
                    echo "<img class='card-img-top' id='profilePicture' src='" . getProfilePicture($user1) . "'>";
                } else {
                    echo "<img class='card-img-top' id='profilePicture' src='Pictures/doge-vector-illustration.png'>";
                }
                echo "</div></a>";


            }
            echo "<!--<th id='deleteChat'><form method='post' action='updates/deleteChat.php'><button class='btn btn-danger' name='deleteChat' value='$chatid'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
              <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
              <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
              </svg></button></form></th>--></li>";

        }

        echo "</ul>";

    $stmt2->free_result();

    $stmt2->close();

    $connection->close();

?>
<script>
    function updateSite(id) {
        location.href = "myChat.php?id=" + id;
    }
    function selectChat(id) {
        document.getElementById(id).style.backgroundColor = "#1e4151";
        document.getElementById(id).style.color = "#c2bd60";
    }


</script>
<?php

if (isset($_GET["id"])) {


    $chatId = $_GET["id"];

    echo
        "<script>
    //update innerHTML
    window.addEventListener('load', function()
    {
        var xhr = null;

        getXmlHttpRequestObject = function()
        {
            if(!xhr)
            {
                // Create a new XMLHttpRequest object
                xhr = new XMLHttpRequest();
            }
            return xhr;
        };

        updateLiveData = function()
        {
            var url = 'html_Files/chat.php?id=' + $chatId;
            xhr = getXmlHttpRequestObject();
            xhr.onreadystatechange = eventHandler;
            // asynchronous requests
            xhr.open('GET', url, true);
            // Send the request over the network
            xhr.send(null);
            document.getElementById('chatPrint').scroll(10000,10000);
        };

        updateLiveData();

        function eventHandler()
        {
            // Check response is ready or not
            if(xhr.readyState == 4 && xhr.status == 200)
            {
                var dataResponse = xhr.responseText;
                var  dataChat  = document.getElementById('chatPrint');

                dataChat.innerHTML = dataResponse;

                // Set current data text

                // Update the live data every 1 sec
                setTimeout(updateLiveData(), 2000);
            }
        }
    });
</script>";
}

?>

<?php
include "html_Files/toggleNight.php";
include "html_Files/footer.php";

echo "</body>";

?>