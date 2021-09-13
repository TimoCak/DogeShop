<?php
    include "html_Files/navbar.php";
    include "html_Files/particles.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Style/buy.css">
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="application/json; charset=UTF-8"/>
    <title>buy</title>
</head>
<body style="background-color: #dec06e">
<br>
<h4>BUY STUFF FOR DOGE!</h4><br>

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
</script>

<form  action="buy.php" method="get">
<div class="input-group" style="width: 50%;height: auto;display: inline-flex;margin-bottom: 20px">
    <input  type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
           aria-describedby="search-addon" name="search" value=""/>
    <?php
        echo "<select id='category' name='category' class='form-control'>";
        if (isset($_GET["category"])) {
        echo "<option style='background-color: #1e4151;color: #c2bd60'>".$_GET["category"]."</option>";
        }
        echo "<option>Movies, Series, Music & Games</option>
        <option>Software</option>
        <option>Electronic & Computer</option>
        <option>Books</option>
        <option>Toys</option>
        <option>Sport</option>
        <option>Car</option>
        <option>Clothes & Accesiores</option>
    </select>";
    ?>
    <button type="submit" class="btn btn-outline-primary">search</button>
</div>
</form>
<?php
    include "Connector/db_connect.php";



    $offset = 20;

    if (isset($_POST["nextPage"])) {
        $maxItems = $_POST["nextPage"];
        $minItems = $maxItems-$offset;
    } else {
        $minItems = 0;
        $maxItems = 20;
    }
    $dbh = $_SESSION['dbh'];
    $sql = "SELECT * FROM information LIMIT ".$minItems.",".$maxItems;

    if (isset($_GET["search"])) {
        $category = $_GET["category"];
        $search = $_GET["search"];
        $sql = "SELECT * FROM information WHERE title='".$search."' or description='".$search."' or category='".$category."' LIMIT ".$minItems.",".$maxItems;
    }
    $res = mysqli_query($dbh, $sql);
    if (!$res) {
        trigger_error('Invalid query '. $dbh->error);
    }
        echo "<div id='data'>";
        if ($res->num_rows > 0) {
            while ($i = $res->fetch_assoc()) {

                echo "<div id='product' class='card-group'><div class='card' >";
                if ($i["title"]=="") {
                    echo "<h2 class='card-title'>Unknown Title</h2>";
                } else {
                    echo "<h2 class='card-title'>" . $i["title"] . "</h2>";
                }

                echo "<p style='margin-left: 50%'><b>" . $i["price"] . "</b> DOGE" .
                    "</p>" . "<img class='card-img-left' width='300px' height='250px' src=".str_replace(" ", "%20", $i['picture'])."></div><br><br>" ."<div class='card'><div class='card-body'><h5 class='card-title'>Description</h5><textarea rows='7' readonly id='description' class='card-text'>".$i["description"]."</textarea></div>";

                echo "<table class='table' style='border-style: solid;border-width: 5px'><tr>";

                if (isset($_SESSION["userid"])) {

                    if ($_SESSION["userid"] == $i["userId"]) {
                        echo "<th class='col'><a class='card-link owner-badge' id='ownerLink' href='myProducts.php' data-toggle='tooltip' title='you are the owner!'>
                           <svg xmlns='http://www.w3.org/2000/svg' width='50' height='40' fill='gold' class='bi bi-person-badge-fill' viewBox='0 0 16 16'>
                           <path d='M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z'/>
                           </svg></a></th>";
                    } else {
                        echo "<th class='col'><form id='contact'  method='post' action='updates/contact.php' ><button data-toggle='tooltip' title='contact seller!' type='submit' name='submit'  value='" . $i["userId"] . "' class='btn btn-outline-success' style='margin-left: 75%;margin-bottom: 5%;'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-people' viewBox='0 0 16 16'>
                            <path d='M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z'/>
                            </svg></button></form></th>";
                        echo "<th><a href='pay.php?pid=".$i["productId"]."' ><img class='buyPicture' data-toggle='tooltip' title='buy product!' src='Pictures/Cjdowner-Cryptocurrency-Flat-Dogecoin-DOGE.svg' width='50' height='40'>
                              </a></th>";

                    }
                } else {
                    echo "<th><a class='car-link login-link' href='login.php'>sign in to buy!</a></th>";
                }
                echo "</tr></table></div></div>";

            }
        } else {
            echo "no matches found!";
        }
        echo "</div>";

$dbh->close();

?>
<?php
    include "html_Files/offset.php";
    echo "<br> <br> <br>";
?>
</body>
</html>
<?php
    include "html_Files/toggleNight.php";
    include "html_Files/footer.php";
?>