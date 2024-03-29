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

        .itemList {
            list-style-type: none;
        }
        #list-elem {
            width: 50%;
            background-color: #1e4151;
            color: #c2bd60;
            display: inline-block;
            margin: 1em;
        }
        .category {
            width: 50%;
            height: 30%;
            display: inline-block;
        }
        .card-header {
            background-color: ghostwhite;
        }
        .card-footer {
            background-color: ghostwhite;
        }
        .card-img-top {
            width: 300px;
            height: 250px;
        }
        @media only screen and (max-width: 800px) {
            #title {
                width: 100px;

            }
            .card-img-top {
                width: 200px;
                height: 200px;

            }
            #list-elem {
                width: 85%;

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

$offset = 20;

if (isset($_POST["nextPage"])) {
    $maxItems = $_POST["nextPage"];
    $minItems = $maxItems-$offset;
} else {
    $minItems = 0;
    $maxItems = 20;
}

$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

$counter = 0;

$userId = $_SESSION["userid"];

$stmt = $connection->prepare("SELECT * FROM information WHERE userId=? LIMIT ".$minItems.",".$maxItems);

$stmt->bind_param("i",$userId);

$stmt->execute();

$stmt->bind_result($title,$description,$wallet,$price,$post_time,$picture,$userId,$productId,$category);

echo "<ol class='itemList'>";

if ($stmt->store_result() > 0) {
    while ($stmt->fetch()) {

        echo "<li id='list-elem' class='card'>"
            . "<form method='post' action='updates/changeTitle.php' class='card-header'><h4>Title:</h4><input id='title' name='changeTitle' type='text' value='".$title."'><button name='submit' type='submit' class='btn btn-primary mb-2' value='$productId'>change</button></form><br>
               <form method='post' action='updates/changeDoge.php'><input step='0.00000001' name='changeDoge' style='width: 100px;' type='number' value='".$price."'> DOGE<br><button name='submit' value='$productId' type='submit' class='btn btn-primary mb-2'>change</button>" .
            "</form><div class='card-body'>";
            echo "<img class='card-img-top img-fluid' id='pictures' src=".str_replace(" ", "%20", $picture)."><br>";
            echo "<form action='updates/changePicture.php' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='MAX_FILE_SIZE' value='3000000' />
        <input type='file' class='form-control-file' id='file' name='picture'><br>
        <button  type='submit' class='btn btn-primary mb-2' value='$productId' name='submit'>changePicture</button>
        </form>";

        echo "<form method='post' action='updates/changeDescription.php'><p style='margin-top: 5%'>Description:</p>" . "<textarea name='changeDescription' style='width: 50%;' rows='3'>".$description."</textarea>
            <br><button name='submit' value='$productId' type='submit' class='btn btn-primary mb-2'>change</button></form>" .
            "<br><form method='post' action='updates/changeCategory.php'> 
            <label for='category'>Category:</label><br>
        <select onload='selected($category)' id='category' name='category' class='form-control category'>
            <option>$category</option>
            <option>Movies, Series, Music & Games</option>
            <option>Software</option>
            <option>Electronic & Computer</option>
            <option>Books</option>
            <option>Toys</option>
            <option>Sport</option>
            <option>Car</option>
            <option>Clothes & Accesiores</option>
        </select><br>
        <button class='btn btn-primary mb-2' type='submit' name='submit' value='$productId'>change</button>
            </form>".
             "<br><form class='form-group' method='post' action='updates/changeWallet.php'>
              <p>Wallet:</p>
              <input id='wallet' oninput='isValid($counter);isEmpty($counter)' name='wallet' style='width: 50%;display: inline-block' type='text' class='form-control validWallet' value='$wallet'>
              <p style='color: red' class='walletError'></p>
              <p style='color: green' class='walletSuccess'></p>
              <button type='submit' name='submit' value='$productId' class='btn btn-primary validWalletButton'>change</button>
                </form></div>
                <div class='card-footer'>
                <form id='deleteProduct' name='deleteProduct' method='post' action='updates/deleteMyProduct.php'>
              <button type='submit' name='delete' value='$productId' class='btn btn-outline-danger' >
               <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
              <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
              <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
              </svg></button></form></div>";
        $counter++;
    }

} else {
    echo "<p>No products posted!</p>";
}
echo "</ol>";



$stmt->free_result();

$stmt->close();

$connection->close();

?>

<script src="JSdata/validWallet.js"></script>

</body>


<?php
include "html_Files/offsetMyProducts.php";
echo "<br> <br> <br>";
include "html_Files/footer.php";
?>



</html>
