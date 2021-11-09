<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Timo Caktu">

    <meta property="og:title" content="sellfordoge">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://sellfordoge.com">
    <meta property="og:image" content="https://sellfordoge.com/Pictures/DogeAstro.jpg">
    <meta property="og:description" content="A free Website where you can buy and sell stuff with Dogecoin!">

    <meta name="twitter:title" content="sellfordoge">
    <meta name="twitter:description" content="A free Website where you can buy and sell stuff with Dogecoin!">
    <meta name="twitter:image" content="https://sellfordoge.com/Pictures/DogeAstro.jpg">

    <meta name="twitter:card" content="summary_large_image">


    <meta name="keywords" content="Dogecoin, doge, DogeShop, shop, shiba inu, e-commerce, php, website, buy, sell, products, stuff, e-bay, amazon, elon musk, rocket launcher, dogehouse, DOGE, cryptocurrencies, bitcoin, litecoin, shibe, memes, community, sale, ethereum, bit, btc, eth">
    <link rel="shortcut icon" type="image/jpg" href="DogeShop/../Pictures/Cjdowner-Cryptocurrency-Flat-Dogecoin-DOGE.svg">
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


<a id="home" href="index.php"> <h1 id="h1">SellForƉoge.com</h1></a>
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
            <li class="nav-item">
                <a class="nav-link" href="buy.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg> buy</a>
            </li>
            <?php
            if (!isset($_SESSION["userid"])) {
                echo "<li class='nav-item'>
                <a class='nav-link' href='login.php'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-tag-fill' viewBox='0 0 16 16'>
                        <path d='M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z'/>
                    </svg> sell</a>
            </li>";
            } else {
                echo "<li class='nav-item'>
                <a class='nav-link' href='sell.php'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-tag-fill' viewBox='0 0 16 16'>
                        <path d='M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z'/>
                    </svg> sell</a>
                </li>";
            }

            ?>
            <li class="nav-item">
                <a class="nav-link" href="users.php"> users</a>
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
                         <a class='nav-link' href='login.php'>
                         <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-bar-left' viewBox='0 0 16 16'>
                         <path fill-rule='evenodd' d='M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z'/>
                         </svg> sign in</a>
                         </li>";
                    echo "<li class='nav-item'>
                         <a class='nav-link' href='signup.php'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-plus-fill' viewBox='0 0 16 16'>
                        <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>
                        <path fill-rule='evenodd' d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z'/>
                        </svg> sign up</a>
                         </li>";
                }
            ?>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button data-toggle="tooltip" title="search with google!"  onclick="doSearch()" class="btn btn-outline-warning my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                </svg> Search</button>
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
