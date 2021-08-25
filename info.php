<?php
include "html_Files/navbar.php";
include "html_Files/particles.php";
?>


<!DOCTYPE html>

<html lang="en">


<head>
    <title>Info</title>
    <link rel="shortcut icon" type="image/x-icon" href="Pictures/DOGE.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            text-align: center;
        }
        #seller {
            background-color: #1e4151;
            width: 50%;
            color: #c2bd60;
            display: inline-block;
        }
        #text {
            background-color: white;
            width: 50%;
            height: auto;
            display: inline-block;
        }
        #buyer {
            background-color: #1e4151;
            width: 50%;
            color: #c2bd60;
            display: inline-block;
        }
        #idea {

        }
    </style>
</head>


<body style="background-color: #dec06e">
    <br><br>
    <div id="text">
    <h1><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">
            <path d="m10.277 5.433-4.031.505-.145.67.794.145c.516.123.619.309.505.824L6.101 13.68c-.34 1.578.186 2.32 1.423 2.32.959 0 2.072-.443 2.577-1.052l.155-.732c-.35.31-.866.434-1.206.434-.485 0-.66-.34-.536-.939l1.763-8.278zm.122-3.673a1.76 1.76 0 1 1-3.52 0 1.76 1.76 0 0 1 3.52 0z"/>
        </svg> Information!</h1> <br>


    <h2 id="idea">Idea of this Website?</h2>

    <h2 id="seller">Seller?</h2>

    <h2 id="buyer">Buyer?</h2>
    </div>



</body>


</html>


<?php
include "html_Files/toggleNight.php";
include "html_Files/footer.php";
?>