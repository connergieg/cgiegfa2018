<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $prodId = $_POST["id"];
    if (isset($prodId)) {
        $sql = "DELETE FROM games_products
                WHERE prodId = :prodId";
        $stmt = $dbConn->prepare($sql);
        $np = array(":prodId" => $prodId);
        $stmt->execute($np);
    }
?>