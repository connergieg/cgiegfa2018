<?php
    include "../../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("c9");
    
    $sql = "SELECT username FROM lab9_user
            WHERE username = :username";
    // echo $sql;
    $stmt = $dbConn->prepare($sql);
    $np = array();
    $np[":username"] = $_GET["username"];
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);
?>