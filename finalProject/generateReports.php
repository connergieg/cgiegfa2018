<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $sql = "SELECT SUM(price) as totalPrice,
            ROUND(AVG(price), 2) as avgPrice,
            COUNT(prodId) as itemCount
            FROM games_products";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($record);
    echo json_encode($record);
?>