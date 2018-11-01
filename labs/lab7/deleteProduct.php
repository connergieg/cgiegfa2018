<?php
    session_start();
    include "inc/functions.php";
    validateSession();
    
    $prodId = $_GET["prodId"];
    if (!isset($prodId)) {
        header("Location: admin.php");
        exit();
    }
    deleteProduct();
?>