<?php

include "./includes/functions.inc.php";


$offset = 20;

$amountOfSites = intdiv(getMyProducts(), $offset) + 1;

$counter = 1;

echo "<div class='container'><div class='row offset'>";

while ($counter <= $amountOfSites) {
    $page = $counter * $offset;
    echo "<div class='col-sm'><form action='' method='post'><button class='btn btn-success page' type='submit' name='nextPage' value='$page'>" . $counter . "</button></form></div><span>-</span>";
    $counter++;
}

echo "</div></div>";
?>
<style>
    .offset {
        display: flex;
    }

    .page {
        background-color: gray;
    }
</style>