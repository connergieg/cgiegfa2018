<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $prodId = $_POST["id"];
    if (isset($prodId)) {
        $sql = "SELECT * FROM games_products
                WHERE prodId = $prodId";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($record);
    }
    
?>