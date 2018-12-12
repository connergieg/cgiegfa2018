<?php
    session_start();
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $sql = "SELECT * FROM games_admin
            WHERE username = :username
            AND password = :password";
    $stmt = $dbConn->prepare($sql);
    $np = array();
    $np[":username"] = $_POST["username"];
    $np[":password"] = sha1($_POST["password"]);
    $stmt->execute($np);
    $record = $stmt->fetch();
    // print_r($record);
    
    if (empty($record)) {
        // echo "Incorrect username or password";
        $_SESSION["loggedIn"] = false;
        header("Location: adminLogin.php?loginAttempt=true");
    } else {
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $record["username"];
        header("Location: adminSection.php");
    }
?>