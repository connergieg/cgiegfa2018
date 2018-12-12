<?php
    include "../inc/dbConnection.php";
    $dbConn = getDatabaseConnection("games");
    
    $prodName = $_POST["name"];
    $prodImg = $_POST["img"];
    $prodGenre = $_POST["genre"];
    $prodConsole = $_POST["console"];
    $prodPrice = $_POST["price"];
    if (isset($prodName)) {
        $sql = "INSERT INTO games_products (prodName, prodImg, Genre, prodConsole, price)
            VALUES (:prodName, :prodImg, :prodGenre, :prodConsole, :prodPrice)";
        $np = array(":prodName" => $prodName, ":prodImg" => $prodImg, ":prodGenre" => $prodGenre,
                    ":prodConsole" => $prodConsole, ":prodPrice" => $prodPrice);
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
    }
?>