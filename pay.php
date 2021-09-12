



<?php
include "html_Files/navbar.php";
include "html_Files/particles.php";
?>
<title>pay</title>
<br><br>
<?php
$servername = "localhost";
$db_name = "products";
$user = "root";
$pass = "t7i9m8o12";

$connection = new mysqli($servername,$user,$pass,$db_name);

$pid = $_GET["pid"];

$stmt = $connection->prepare("SELECT * FROM information WHERE productId=?");

$stmt->bind_param("i",$pid);

$stmt->execute();

$stmt->bind_result($title,$description, $wallet, $price, $post_time, $picture, $userId, $productId,$category);

while($stmt->fetch()) {
    echo "<div class='card' style='width: 50%'>";
    echo "<img class='card-img-top' src='".$picture."'>";
    echo "<div class='card-body'>";
    echo "<h4 class='card-header'>".$title."</h4>";
    echo "<p readonly class='card-text'>$description</p>";
    echo "<p>------------------------------------------</p>";
    echo "<p class='card-text'>Price: $price DOGE</p>";
    echo "<p class='card-text'>Wallet: ".$wallet."</p>";
    echo "<div class='container'><div class='row'> <div class='col-sm'><form action='' method='post'>
            <button onclick='doAlert()' value='$productId' name='pid' class='btn btn-primary'>buy now!</button>
            <input hidden name='seller' value='$userId'>
            <input hidden name='buyer' value='".$_SESSION["userid"]."'></form></div>";
    echo "<div class='col-sm'><form id='contact'  method='post' action='updates/contact.php' ><button data-toggle='tooltip' title='contact seller!' type='submit' name='submit'  value='$userId' class='btn btn-outline-success' style='margin-left: 75%;margin-bottom: 5%;'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-people' viewBox='0 0 16 16'>
                            <path d='M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z'/>
                            </svg></button></form></div>";
    echo "</div></div></div></div>";
}

$stmt->free_result();

$stmt->close();

$connection->close();

?>
<style>
    .card-header {
        background-color: #1e4151;
        color: #c2bd60;
    }
    .btn {
        color: #dec06e;
        background-color: #111111;
    }
    .btn:hover {
        color: #111111;
        background-color: #dec06e;
    }
    .card-text {
        border-style: solid;
        border-color: #c2bd60;
        border-width: 5px;
    }
    .card {
        display: block;
        margin: auto;
    }
</style>

<script>
    function doAlert() {
        alert("contact the seller and pay with your doge wallet!");
    }
</script>
























<?php
include "html_Files/footer.php";
?>

