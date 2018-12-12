<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $prodId = $_POST["id"];
    if (isset($prodId)) {
        $sql = "UPDATE games_history
                SET views = views+1
                WHERE prodId = $prodId";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
    }
    
?>