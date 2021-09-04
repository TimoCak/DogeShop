<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../Pictures/Cjdowner-Cryptocurrency-Flat-Dogecoin-DOGE.svg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
        .navbar-custom  {
            background-color: #1e4151;

        }
        #h1 {
            margin: 0;
            padding: 10px;
        }
        #home {
            text-decoration: none;
        }


        #h1 {
            text-align: center;
            padding: 1em;
            background-color: #1e4151;
            color: #c2bd60;

        }
        body {
            background-color: #dec06e;
        }

    </style>
</head>
<body>


<a id="home" href="index.php"> <h1 id="h1">Ɖoge Shop</h1></a>
<nav class="navbar navbar-expand-sm navbar-dark navbar-custom">
    <a class="navbar-brand" href="#"><img src="Pictures/TC.png" width="50px" height="30px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navbar-nav" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" style="color: red;">
            <li class="nav-item">
                <a class="nav-link" href="info.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg></a>
            </li>
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<li class='nav-item'>
                         <a class='nav-link' href='profile.php'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-person-fill' viewBox='0 0 16 16'>
                        <path d='M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>
                        </svg>" . $_SESSION["useruid"] ."</a>
                         </li>";
                    echo "<li class='nav-item'>
                         <a class='nav-link' href='includes/logout.inc.php'><svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-arrow-bar-right' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z'/>
                        </svg> logout</a>
                         </li>";
                } else {
                    echo "<li class='nav-item'>
                         <a class='nav-link' href='login.php'>sign in</a>
                         </li>";
                    echo "<li class='nav-item'>
                         <a class='nav-link' href='signup.php'>sign up</a>
                         </li>";
                }
            ?>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button onclick="doSearch()" class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
        </form>

        <p id="lol"></p>

    </div>
</nav>

<script>
    var eingabe = document.getElementById('search');
    var ausgabe = document.getElementById('lol');

    function doSearch() {
        window.open('https://www.google.com/search?q=' + eingabe.value);
    }

</script>

</body>
</html>
