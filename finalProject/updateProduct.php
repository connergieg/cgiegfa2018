<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $prodId = $_POST["id"];
    $prodName = $_POST["name"];
    $prodImg = $_POST["img"];
    $prodGenre = $_POST["genre"];
    $prodConsole = $_POST["console"];
    $prodPrice = $_POST["price"];
    if (isset($prodId)) {
        $sql = "UPDATE games_products
                SET prodName = :prodName,
                prodImg = :prodImg,
                Genre = :prodGenre,
                prodConsole = :prodConsole,
                price = :prodPrice
                WHERE prodId = $prodId";
        $np = array(":prodName" => $prodName, ":prodImg" => $prodImg,
        ":prodGenre" => $prodGenre, ":prodConsole" => $prodConsole, ":prodPrice" => $prodPrice);
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
    }
    
?>