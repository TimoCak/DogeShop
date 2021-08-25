<!DOCTYPE html>

<html>

<?php
include "html_Files/navbar.php";
include "html_Files/particles.php";

?>
<?php

?>

<head>
    <meta charset="UTF-8">
    <title>myProducts</title>
    <style>
        body {
            background-color: #dec06e;
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
        #pictures {
            width: 500px;
            height: 400px;
        }

        @media only screen  and (max-width: 800px){
            #pictures {
                width: 250px;
                height: 175px;
            }
        }
        .itemList {
            column-count: 1;
            text-align: center;
            margin-right: 2.5em;
        }
        #list-elem {
            width: 800px;
            height: 1200px;
        }
        @media only screen and (max-width: 800px) {
            #list-elem {
                width: 400px;
                height: 950px;
            }

        }

    </style>

</head>

<body>
<br><br>
<h1 style="display: inline;margin-right: 10px;" ><a href="profile.php" id="personal">Personal Info</a></h1>
<h1 style="display: inline; background-color: #1e4151; color: #c2bd60;margin-right: 10px;">MyProducts</h1>
<h1 style="display: inline;margin-right: 10px;"><a href="myChat.php" id="personal">MyChats</a></h1>
<br><br>
<?php

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

$userId = $_SESSION["userid"];

$stmt = $connection->prepare("SELECT * FROM information WHERE userId=?");

$stmt->bind_param("i",$userId);

$stmt->execute();

$stmt->bind_result($title,$description,$wallet,$price,$post_time,$picture,$userId,$productId);

echo "<ol class='itemList'>";

if ($stmt->store_result() > 0) {
    while ($stmt->fetch()) {
        echo "<li id='list-elem' style='border: 2px;border-style: solid;background-color: #1e4151;color: #c2bd60;display: inline-block;margin-bottom: 1em;padding-bottom: 0;'>"
            . "<br>
              <form method='post' action='updates/changeTitle.php'><label>title:</label><br><input name='changeTitle' type='text' value='".$title."'><button name='submit' type='submit' class='btn btn-primary mb-2' value='$productId'>change</button></form><br>
               <form method='post' action='updates/changeDoge.php'><input step='0.00000001' name='changeDoge' style='width: 100px;' type='number' value='".$price."'> DOGE<br><button name='submit' value='$productId' style='margin-right: 50px;' type='submit' class='btn btn-primary mb-2'>change</button>" .
            "</form><br>";
            echo "<img id='pictures' src=".str_replace(" ", "%20", $picture)."><br>";
            echo "<form action='updates/changePicture.php' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='MAX_FILE_SIZE' value='3000000' />
        <input type='file' class='form-control-file' id='file' name='picture' style='margin-left: 25%'> <br><br>
        <button id='button' type='submit' class='btn btn-primary mb-2' value='$productId' name='submit'>changePicture</button>
        </form>";

        echo "<form method='post' action='updates/changeDescription.php'><p style='margin-top: 5%'>Description:</p>" . "<textarea name='changeDescription' style='width: 50%;height: 250px'>".$description."</textarea>
            <br><button name='submit' value='$productId' type='submit' class='btn btn-primary mb-2'>change</button></form>" .
             "<form onsubmit='confDel()' id='deleteProduct' name='deleteProduct' method='post' action='updates/deleteMyProduct.php'>
              <button type='submit' name='delete' value='$productId' class='btn btn-outline-danger' style='margin-left: 75%;margin-bottom: 5%;'>
               delete</button></form></li>";
        echo "<p>$productId</p>";
    }

} else {
    echo "<p>No products posted!</p>";
}
echo "</ol>";



$stmt->free_result();

$stmt->close();

$connection->close();

?>
<style>

</style>
<script>
    function confDel() {
        var conf = confirm("Are you sure you want to delete this product?");

        if (!conf) {
            document.getElementById("deleteProduct").action = "";
        }
    }

</script>


</body>


<?php
include "html_Files/footer.php";
?>



</html>
