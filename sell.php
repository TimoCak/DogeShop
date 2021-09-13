<?php
    include_once "Connector/db_connect.php";
    include "html_Files/navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style/sell.css">
    <title>sell</title>
</head>

<body style="background-color: #dec06e">
<br><br>
<h5>Please,fill out the following fields. You should specially use the description field to advertise your product!</h5>
<br><br><br>
<form action="sell.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title:</label><br>
        <input id="title" class="form-control" name="title">
        <br><br>
        <label>Description:</label><br>
        <textarea id="description" type="text" class="form-control" rows="5" name="description"></textarea>
        <br><br>
        <label for="category">Category:</label><br>
        <select id="category" name="category" class="form-control">
            <option selected>Movies, Series, Music & Games</option>
            <option>Software</option>
            <option>Electronic & Computer</option>
            <option>Books</option>
            <option>Toys</option>
            <option>Sport</option>
            <option>Car</option>
            <option>Clothes & Accesiores</option>
        </select><br><br>
        <label>price:</label><br> <input style="width: 10%;height: auto;background-color: #c2bd60;color: black; display: inline-block;
    " id="price" class="form-control" type="number" step="0.00000001" name="price"> <label>DOGE</label>
        <br><br>
        <label>your public key:</label><br>
        <input id="wallet" class="form-control" name="wallet" oninput="isValid()">
        <p style="color: red" id="walletError"></p>
        <p style="color: green" id="walletSuccess"></p>
        <br><br>
        <label>select picture:</label><br><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
        <input type="file" class="form-control-file" id="file" name="picture"> <br><br>
        <input id="button" type="submit" class="btn btn-primary mb-2" value="submit" name="send">

    </div>
</form>

<script>

     function isValid() {
        var request = new XMLHttpRequest();
         request.open("GET","https://chain.so/api/v2/is_address_valid/DOGE/" + document.getElementById('wallet').value);
         request.addEventListener('load', function () {
               console.log(request.response);
                if (request.status >= 200 && request.status < 300) {
                    var respObject = JSON.parse(request.response);
                    if (respObject.data.is_valid === false) {
                        document.getElementById("walletError").innerHTML = respObject.data.address.toString() + " is invalid!";
                        document.getElementById("button").disabled = true;
                        document.getElementById("walletSuccess").style.visibility = "hidden";
                        document.getElementById("walletError").style.visibility = "visible";
                    } else if(respObject.data.is_valid === true) {
                        document.getElementById("walletSuccess").innerHTML = "HELLO SHIBE";
                        document.getElementById("button").disabled = false;
                        document.getElementById("walletSuccess").style.visibility = "visible";
                        document.getElementById("walletError").style.visibility = "hidden";
                        console.log(respObject);

                    }
                } else {
                    console.warn(request.statusText, request.responseText);
                }

            });

       request.send();
    }


</script>

<?php
if(isset($_POST['send'])) {


    if (is_dir("upload/".$_SESSION["userid"])==false) {
        mkdir("upload/".$_SESSION["userid"],0775);
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $wallet = $_POST['wallet'];
    $picture =  "upload/".$_SESSION["userid"]."/".basename($_FILES['picture']['name']);
    $price = $_POST['price'];
    $post_time = date("Y-m-d H:i:s");
    $usersId = $_SESSION["userid"];
    $category = $_POST["category"];

   include "Connector/db_connect.php";

   $dbh = $_SESSION['dbh'];

    # echo 'Title:  ' . $title .'<br>';
    # echo 'Description:  ' . $description .'<br>';
    # echo 'Price :' . $price . '<br>';
    # echo 'Wallet:  ' . $wallet .'<br>';
    # echo 'Picture:  <img src="' . $picture .'"><br>';
    # echo 'Date: ' . $post_time .'<br>';

    if (isset($_SESSION["userid"])) {


        $sendToDB = $dbh->prepare("INSERT INTO information (title,description,wallet,price,post_time,picture,userId,category) VALUES (?,?,?,?,?,?,?,?)");
        $sendToDB->bind_param('sssdssis', $title, $description, $wallet, $price, $post_time, $picture, $_SESSION["userid"],$category);
        if ($sendToDB === false) {
            die ($dbh->error);
        }
        $sendToDB->execute();


        if ($_FILES["picture"]["error"] > 0) {
            echo "Error: " . $_FILES["picture"]["error"] . "<br>";
        } else {
            move_uploaded_file($_FILES["picture"]["tmp_name"],
                "upload/".$_SESSION["userid"]."/" . $_FILES["picture"]["name"]);
            echo "<script> window.alert('Data succesfully posted! you will be moved to the your products');
                           location.href = 'myProducts.php'; </script>";
        }

        $sendToDB->free_result();

        $sendToDB->close();
    } else {
        echo "<p style='color: red'>YOU NEED TO BE LOGGED IN!</p>";
    }
    $dbh->close();


}
?>

</body>
</html>

<?php
    include "html_Files/toggleNight.php";
    include "html_Files/footer.php";
?>




