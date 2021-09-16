<!DOCTYPE html>

<html>

<?php
    include "html_Files/navbar.php";
    include "html_Files/particles.php";

?>

<head>
    <meta charset="UTF-8">
    <title>Profile</title>

    <style>
        #user {
            color: #c2bd60;
            margin-top: 5%;
            background-color: #1e4151;
            width: 50%;
            height: auto;
            display: inline-block;
        }
        body {
            text-align: center;

        }
        .form-control {
            width: 50%;
            height: auto;
            display: inline-block;

        }
        #products {
            text-decoration: none;
            background-color: grey;
            color: white

        }
        #products:hover {
            background-color: #1e4151;
            color: #c2bd60;
        }

        #personalInfo {
            background-color: #1e4151;
            width: 50%;
            height: auto;
            margin: auto;
            color: #c2bd60;
        }

        @media only screen and (max-width: 800px) {
            #user {
                width: 85%;
            }
            .form-control {
                width: 85%;
            }
            #personalInfo {
                width: 85%;
            }

        }

    </style>

</head>



<body style="background-color: #dec06e">
    <br><br>
    <h1 style="display: inline; margin-right: 10px; background-color: #1e4151; color: #c2bd60">Personal Info</h1>
    <h1 style="display: inline;margin-right: 10px;"><a href="myProducts.php" id="products">MyProducts</a></h1>
    <h1 style="display: inline;margin-right: 10px;"><a href="myChat.php" id="products">MyChats</a></h1><br><br>
    <?php
        include "Connector/db_connect.php";

        $username = $_SESSION["useruid"];
        $uid = $_SESSION["userid"];
        $dbh = $_SESSION["dbh"];

        $sql = "SELECT * FROM users WHERE usersId=".$uid;
        $res = $dbh->query($sql);
        if ($res->num_rows > 0) {
           while($i = $res->fetch_assoc()) {

            echo "<div id='user'>";
               if ($i["usersVerified"]==1) {
                   echo "<h2>$username <span data-toggle='tooltip' title='verified'><svg data-toggle='tooltip' title='verified' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16' >
                         <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
                         </svg></span></h2>";
               } else {
                   echo "<h2>$username</h2>";
               }
           if ($i["usersPicture"]!=null) {
              echo  "<img style='border-style: solid' width='150px' height='150px' src='".str_replace(' ', '%20', $i['usersPicture'])."'><br><br>";
              echo "<form onsubmit='reallyDelete()' action='' method='post' id='deleteProfilePicture'>
                    <button  name='delete' class='btn btn-outline-danger '><svg xmlns='http://www.w3.org/2000/svg' width='10' height='10' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
              <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
              <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
              </svg></button><br><br>
                   </form> ";
           } else {
             if (!file_exists("upload/".$_SESSION["userid"])) {
                 mkdir("upload/".$_SESSION["userid"]);
             }
             echo "<form action='updates/postProfilePicture.php' method='post' enctype='multipart/form-data'>
                   <input type='hidden' name='MAX_FILE_SIZE' value='3000000'/>
                   <input type='file' class='form-control-file' id='file' name='profilePicture' style='margin-left: 25%'><br><br>
                   <button id='button' type='submit' class='btn btn-primary mb-2' name='submit'>add Profile picture</button></form>";

           }


               echo "</div><br><br>";

                   echo "<div id='personalInfo'>
                         <form method='post' action='updates/changeName.php'>   
                         <p><b>Full Name</b></p> 
                         <input class='form-control' id='name' type='text' name='name' placeholder='".str_replace(' ',' ',$i["usersName"])."'><br>
                         <input class='btn btn-primary mb-2' id='change' type='submit' name='change' value='change'><br><br>
                         </form>";
                    if (isset($_GET["successName"])) {
                        if ($_GET["successName"] == "1") {
                            echo "<p style='color: green'>successfully changed!</p>";
                        }
                        if ($_GET["successName"] == "0") {
                            echo "<p style='color: red'>empty name!</p>";
                        }
                    }
                    echo "<form method='post' action='updates/changeEmail.php'>
                         <p><b>E-Mail</b></p> 
                         <input class='form-control' id='email' type='text' name='email' placeholder=".$i["usersEmail"]."><br>
                         <input class='btn btn-primary mb-2' id='change' type='submit' name='change' value='change'><br><br>
                         </form>";
                    if (isset($_GET["successEmail"])) {
                        if ($_GET["successEmail"] == "1") {
                            echo "<p style='color: green'>successfully changed!</p>";
                        }
                        if ($_GET["successEmail"] == "0") {
                            echo "<p style='color: red'>invalid E-Mail!</p>";
                        }
                        if ($_GET["successEmail"] == "taken") {
                            echo "<p style='color: red'>E-Mail already taken!</p>";
                        }
                    }

                    echo "<form method='post' action='updates/changeUsername.php'>
                            <p><b>Username</b></p> 
                         <input class='form-control' id='uid' type='text' name='uid' placeholder=".$i["usersUid"]."><br>
                         <input class='btn btn-primary mb-2' id='change' type='submit' name='change' value='change'><br><br>
                         </form>";
               if (isset($_GET["successUid"])) {
                   if ($_GET["successUid"] == "1") {
                       echo "<p style='color: green'>successfully changed!</p>";
                   }
                   if ($_GET["successUid"] == "0") {
                       echo "<p style='color: red'>invalid Username!</p>";
                   }
                   if ($_GET["successUid"] == "taken") {
                       echo "<p style='color: red'>Username is taken!</p>";
                   }
               }

               echo  "<form method='post' action='updates/changePwd.php'> <p><b>Password</b></p>
                         <input class='form-control' id='usersPwd' type='password' name='pwd' placeholder='type in new Password...'>
                         <input class='form-control' id='usersRePwd' type='password' name='repwd' placeholder='repeat new Password...'><br>
                         <input class='btn btn-primary mb-2' id='change' type='submit' name='change' value='change'>   
                           </form>";
               if (isset($_GET["successPwd"])) {
                   if ($_GET["successPwd"] == "1") {
                       echo "<p style='color: green'>successfully changed!</p>";
                   }
                   if ($_GET["successPwd"] == "0") {
                       echo "<p style='color: red'>passwords don't match!</p>";
                   }
               }
               echo            "</div><br><br>";





               echo "<script>console.log('".$i["usersUid"]."')</script>";
           }
        }




    ?>

<script>
    function reallyDelete() {
        var conf = confirm("Really wanna delete this picture?");

        if (conf) {
            document.getElementById("deleteProfilePicture").action = 'updates/deleteProfilePicture.php';
        }
    }
</script>

</body>



<?php
    include "html_Files/footer.php";
?>

</html>
