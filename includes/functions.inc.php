<?php

function emptyInputSignup($name,$email,$username,$pwd,$pwdRepeat) {
    $result = false;

    if (empty($name)||empty($email)||empty($username)||empty($pwd)||empty($pwdRepeat)) {
        $result = true;
    }

    return $result;
}

function invalidUid($username) {
    $result = false;

    if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
        $result = true;
    }

    return $result;

}

function invalidEmail($email) {
    $result = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }

    return $result;

}

function pwdMatch($pwd,$pwdRepeat) {
    $result = false;

    if ($pwd !== $pwdRepeat) {
        $result = true;
    }

    return $result;

}

function uidExists($dbh,$username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($dbh);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss",$username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
       return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//usernameExists() differs from the functions.inc.php uidExists()

function usernameExists($dbh, $uid) {
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($dbh);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../profile.php?successUid=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function emailExists($dbh, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($dbh);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../profile.php?successEmail=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($dbh,$name,$email,$username,$pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($dbh);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss",$name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();
}

function emptyInputLogin($username,$pwd) {
    $result = false;

    if (empty($username)||empty($pwd)) {
        $result = true;
    }

    return $result;
}

function loginUser($dbh, $username, $pwd) {
    $uidExists = uidExists($dbh,$username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}

function duplicateChat($user1, $user2) {

    if (isset($_SESSION["userid"])) {
        $servername = "localhost";
        $db_name = "products";
        $user = "root";
        $pass = "t7i9m8o12";

        $connection = new mysqli($servername,$user,$pass,$db_name);


        #create chat
        $stmt = $connection->query("SELECT user1,user2 FROM chats");
        $duplicate = false;

        while ($row = $stmt->fetch_assoc()) {
            if ($user1==$row["user1"]&&$user2==$row["user2"]) {
                $duplicate = true;
            } elseif ($user1==$row["user2"]&&$user2==$row["user1"]) {
                $duplicate = true;
            }
        }

        $stmt->free_result();


        $connection->close();

        return $duplicate;
    }


}


function giveChatId($user1,$user2) {

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);


    $stmt = $connection->prepare("SELECT chatId FROM chats WHERE user1=? AND user2=?");

    $stmt->bind_param("ii",$user1,$user2);

    $stmt->execute();

    $stmt->bind_result($chatid);

    $res = $chatid;

    while ($stmt->fetch()) {
        $res = $chatid;
    }

    $stmt->free_result();

    $stmt->close();

    if ($res==null) {
        $stmt1 = $connection->prepare("SELECT chatId FROM chats WHERE user1=? AND user2=?");
        $stmt1->bind_param("ii",$user2,$user1);
        $stmt1->execute();

        $stmt1->bind_result($chatid);

        while ($stmt1->fetch()) {
            $res = $chatid;
        }

        $stmt1->free_result();

        $stmt1->close();
    }

    $connection->close();

    return $res;

}

function giveUsername($userid) {

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);


    $stmt = $connection->prepare("SELECT usersUid FROM users WHERE usersId=?");

    $stmt->bind_param("i",$userid);

    $stmt->execute();

    $stmt->bind_result($username);

    if($stmt->fetch()) {
        return $username;
    }

    $stmt->free_result();

    $stmt->close();

    $connection->close();


}

function selectHistory($chatId) {

    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);

    $res = $connection->query(" SELECT * FROM history".$chatId);

    return $res;
}

function postMessage($chatId,$userId,$message) {
    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);

    $connection->query("INSERT INTO history".$chatId." (userId, message) VALUES ('$userId','$message')");


    $connection->close();

}

function deleteChat($chatId) {
    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername,$user,$pass,$db_name);

    $connection->query("DELETE FROM chats WHERE chatId='$chatId'");

    $connection->query("DROP TABLE history".$chatId);


    $connection->close();

}

function getProfilePicture($userId)
{
    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername, $user, $pass, $db_name);

    $stmt = $connection->prepare("SELECT usersPicture FROM users WHERE usersId=?");

    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $stmt->bind_result($picture);

    if ($stmt->fetch()) {
        return $picture;
    }

    $stmt->free_result();

    $stmt->close();

    $connection->close();

}

  function existsChatId($chatId): bool
  {
    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername, $user, $pass, $db_name);

    $stmt = $connection->prepare("SELECT chatId FROM chats WHERE chatId=?");

    $stmt->bind_param("i",$chatId);

    $stmt->bind_result($chatid);

    if ($stmt->fetch()) {
        return true;
    }
    $stmt->free_result();

    $stmt->close();

    $connection->close();
    return false;
}

function isUserInChat($chatId) {

    if (isset($_SESSION["userid"])) {


        $servername = "localhost";
        $db_name = "products";
        $user = "root";
        $pass = "t7i9m8o12";

        $connection = new mysqli($servername, $user, $pass, $db_name);

        $stmt = $connection->prepare("SELECT user1,user2 FROM chats WHERE chatId=?");

        $stmt->bind_param("i", $chatId);

        $stmt->execute();

        $stmt->bind_result($user1, $user2);

        if ($stmt->fetch()) {
            if ($_SESSION["userid"] !== $user1 && $_SESSION["userid"] !== $user2) {
                return false;
            }
            return true;
        }
    }
}

function getAllProducts() {
    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername, $user, $pass, $db_name);

    $stmt = $connection->query("SELECT * FROM information");

    $amount = mysqli_num_rows($stmt);

    $connection->close();

    return $amount;
}

function getMyProducts()
{
    $servername = "localhost";
    $db_name = "products";
    $user = "root";
    $pass = "t7i9m8o12";

    $connection = new mysqli($servername, $user, $pass, $db_name);

    $stmt = $connection->prepare("SELECT * FROM information WHERE userId=?");

    $stmt->bind_param("i",$_SESSION["userid"]);

    $stmt->execute();

    $amount = $stmt->num_rows;

    $connection->close();

    return $amount;
}

