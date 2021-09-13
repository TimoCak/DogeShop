<?php
    include "html_Files/navbar.php";
?>
<title>Signup</title>
<body style="background-color: #dec06e">
<section>
    <div style="text-align: center">
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="post"><br><br>
        <input class="form-control" id="signupName" type="text" name="name" placeholder="Full name..."><br><br>
        <input class="form-control" id="signupEmail" type="text" name="email" placeholder="Email..."><br><br>
        <input class="form-control" id="signupUid" type="text" name="uid" placeholder="Username..."><br><br>
        <input class="form-control" id="signupPwd" type="password" name="pwd" placeholder="Password..."><br><br>
        <input class="form-control" id="signupPwdRepeat" type="password" name="pwdrepeat" placeholder="Repeat password..."><br><br>
        <button class="btn btn-primary mb-2" type="submit" name="submit">Sign Up</button>
    </form>
        <?php
        if(isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Please, all information is required!</p>";
            }
            else if($_GET["error"] == "invaliduid") {
                echo "<p>Username is invalid!</p>";
            }
            else if($_GET["error"] == "invalidemail") {
                echo "<p>E-mail is invalid!</p>";
            }
            else if($_GET["error"] == "nopwdmatch") {
                echo "<p>Passwords aren't equal!</p>";
            }

            else if($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong, please try again!</p>";
            }
            else if($_GET["error"] == "usernametaken") {
                echo "<p>Username is already taken!</p>";
            }
            else if($_GET["error"] == "none") {
                echo "<script>Window.alert('Signed up succesfully!');</script>";
            }
        }
        ?>
    </div>

</section>
</body>
<style>
    #signupName {
        width: 40%;
        height: auto;
        background-color: #c2bd60;
        color: black;
        display: inline-block;
    }
    #signupEmail {
        width: 40%;
        height: auto;
        background-color: #c2bd60;
        color: black;
        display: inline-block;
    }
    #signupUid {
        width: 40%;
        height: auto;
        background-color: #c2bd60;
        color: black;
        display: inline-block;
    }
    #signupPwd {
        width: 40%;
        height: auto;
        background-color: #c2bd60;
        color: black;
        display: inline-block;
    }
    #signupPwdRepeat {
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