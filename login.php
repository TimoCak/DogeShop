<?php
include "html_Files/navbar.php";
?>

<title>Login</title>
<body style="background-color: #dec06e">
<section>
    <div style="text-align: center">
        <h2>Log In</h2>
        <form action="includes/login.inc.php" method="post"><br><br>
            <input id="loginName" type="text" name="uid" class="form-control" placeholder="Username/Email..."><br><br>
            <input id="loginPwd" type="password" name="pwd" class="form-control" placeholder="Password..."><br><br>
            <button class="btn btn-primary mb-2" type="submit" name="submit">Log In</button>
        </form>
        <?php
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p style='color: red'>Please, all information is required!</p>";
            }
            else if($_GET["error"] == "wronglogin") {
                echo "<p style='color: red'>Wrong login!</p>";
            }
        }
        ?>
    </div>
</section> <br><br>
<div style="text-align: center">
<span>No account? </span><a href="signup.php">sign up</a>
</div>
</body>
<style>
    #loginName {
        width: 40%;
        height: auto;
        background-color: #c2bd60;
        color: black;
        display: inline-block;
    }
    #loginPwd {
        width: 40%;
        height: auto;
        background-color: #c2bd60;
        color: black;
        display: inline-block;
    }
</style>

<?php
include "html_Files/toggleNight.php";
include "html_Files/footer.php";
?>
