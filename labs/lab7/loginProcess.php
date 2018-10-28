<?php
    session_start();
    include "../../dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $encpassword = sha1($_POST["password"]);
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    
    // This SQL does not prevent SQL injection
    // $sql = "SELECT * FROM om_admin
    //         WHERE username = '$username'
    //         AND password = '$password'";
    $sql = "SELECT * FROM om_admin
            WHERE username = :username
            AND password = :password";
    $stmt = $dbConn->prepare($sql);
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $encpassword;
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting just one record
    // print_r($record);
    
    if (empty($record)) {
        // echo "Wrong username or password!";
        $link = "index.php";
        if (!empty($_SESSION["username"]) || !empty($_SESSION["password"])) {
            $link .= "?loginErr=true";
        }
        header("Location: $link");
    } else {
        // echo "Welcome " . $record["firstName"] . " " . $record["lastName"];
        $_SESSION["adminFullName"] = $record["firstName"] . " " . $record["lastName"];
        header("Location: admin.php"); //redirects to another program
    }
?>