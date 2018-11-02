<?php
    session_start();
    include "inc/functions.php";
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["password"] = $_POST["password"];
    
    // validateLogin();
?>