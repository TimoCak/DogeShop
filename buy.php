<?php
    include "html_Files/navbar.php";
    include "html_Files/particles.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="Pictures/DOGE.png">
    <link rel="stylesheet" type="text/css" href="Style/buy.css">
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="application/json; charset=UTF-8"/>
    <title>Doge Shop: buy</title>
</head>
<body style="background-color: #dec06e">

<h5>Posted products!</h5>

<label>Amount of Doge: </label><p id="response"></p>

<script language="JavaScript">

    //Globale get-Methods

    var request = new XMLHttpRequest();
    request.open("GET","https://dogechain.info/api/v1/address/balance/DPMwmsSfZsF8zr7KU2wMPEJPHfhd1pEgDd");
    request.addEventListener('load', function(event) {
        if (request.status >= 200 && request.status < 300) {
            const respObject = JSON.parse(request.response);
            console.log(request.response);
            document.getElementById("response").innerHTML = respObject.balance.toString();
            console.log(respObject);
        } else {
            console.warn(request.statusText, request.responseText);
        }
    });
    request.send();

    function showWalletInfo() {

    }
</script>

<form action="buy.php" method="get">
<div class="input-group" style="width: 50%;height: auto;display: inline-flex;margin-bottom: 20px">
    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
           aria-describedby="search-addon" name="search"/>
    <button type="submit" class="btn btn-outline-primary" name="submit">search</button>
</div>
</form>
<?php

    include "Connector/db_connect.php";

    $dbh = $_SESSION['dbh'];
    $sql = "SELECT * FROM information;";
    if (isset($_GET["submit"])) {
        $sql = "SELECT * FROM information WHERE title='".$_GET['search']."'";
    }
    $res = mysqli_query($dbh, $sql);

        echo "<ol>";
        if ($res->num_rows > 0) {
            while ($i = $res->fetch_assoc()) {

                echo "<li style='border: 2px;border-style: solid;background-color: #1e4151;color: #c2bd60;width: 70%;height: auto;display: inline-block;margin-bottom: 1em;padding-bottom: 0;'>"
                    . "<h2>" . $i["title"] . "</h2>" . "<p style='margin-left: 50%'><b>" . $i["price"] . "</b> DOGE" .
                    "</p>" . "<img width='50%' height='auto' src=".str_replace(" ", "%20", $i['picture'])."><br>" . "<p style='margin-top: 5%'>Description:</p>" . "<textarea readonly style='width: 50%;height: 250px'>" . $i["description"] . "</textarea>" .
                    "<form method='post' action='updates/contact.php'>
                    <button onlclick='contact()' type='submit' name='submit'  value='".$i["userId"]."' class='btn btn-outline-success' style='margin-left: 75%;margin-bottom: 5%;'>CONTACT</button></form>" . "</li>";

            }
        } else {
            echo "no matches found!";
        }
        echo "</ol>";

$dbh->close();

?>

<script type='text/javascript'>
    function contact() {
        var conf = window.confirm('You wanna contact buyer?');

        if (!conf) {
            document.getElementById('contact').action = '';
        }
    }

</script>

</body>
</html>
<?php
    include "html_Files/toggleNight.php";
    include "html_Files/footer.php";
?>