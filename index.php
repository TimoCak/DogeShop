<?php
    include 'html_Files/navbar.php';
    include 'html_Files/particles.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Style/look.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body style="background-color: #dec06e;">

<?php
    include "html_Files/DogePrice.php";
?>

<noscript>
    Please, make sure to enable JavaScript to use this Webapplication!
</noscript>
<br><br>

<button onclick="openLink()" class="actions"><h2>Much buy <img src="Pictures/doge-vector-illustration.png" width="50" height="50"></h2></button>
<button onclick="openLink1()" class="actions"><h2>Such sell <img src="Pictures/doge-vector-illustration.png" width="50" height="50"></h2></button>
<br>

<?php
    include "Connector/db_connect.php";

    $dbh = $_SESSION["dbh"];
    $sql = "SELECT * FROM users;";
    $res = $dbh->query($sql);
    $amount = mysqli_num_rows($res);
    $dbh->close();

# will be activated when there are more users!
 echo "<h5>".$amount." registered shibes</h5> ";

?>



<script>
    function openLink() {
        location.href = 'buy.php';
    }
</script>

<?php
    if (isset($_SESSION["useruid"])) {
       echo "<script>function openLink1() {
            location.href = 'sell.php'}</script>";
    } else {
        echo "<script>function openLink1() {
           location.href = 'login.php';}</script>";
    }
?>

</body>
</html>

<?php
    //First ever php file :)
    include 'html_Files/toggleNight.php';
    include "html_Files/footer.php";
?>




