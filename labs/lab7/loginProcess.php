<?php
    session_start();
    include "../../../dbConnection.php";
    $dbConn = getDatabaseConnection("ottermart");
    // include "inc/functions.php";
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["password"] = $_POST["password"];
    
    // validateLogin();
    $sql = "SELECT * FROM om_admin
                WHERE username = :username
                AND password = :password";
    $stmt = $dbConn->prepare($sql);
    $np = array();
    $np[":username"] = $_POST["username"];
    $np[":password"] = sha1($_POST["password"]);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting just one record
    // print_r($record);
    
    if (empty($record)) {
        // echo "Wrong username or password!";
        $_SESSION["loggedIn"] = false;
        header("Location: index.php?loginAttempt=true");
    } else {
        // echo "Welcome " . $record["firstName"] . " " . $record["lastName"];
        $_SESSION["loggedIn"] = true;
        $_SESSION["adminFullName"] = $record["firstName"] . " " . $record["lastName"];
        header("Location: admin.php"); //redirects to another program
    }
?>