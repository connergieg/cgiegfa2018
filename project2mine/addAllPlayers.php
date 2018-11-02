<?php
    session_start();
    $catId = $_GET["catId"];
    $priceFrom = $_GET["priceFrom"];
    $priceTo = $_GET["priceTo"];
    $submit = $_GET["submit"];
    $orderBy = $_GET["orderBy"];
    $sortBy = "ASC";
    include "dbConnection.php";
    $dbConn = getDatabaseConnection("sports");
    
    
    $sql = "SELECT * FROM sports_players
            WHERE catId = :catId";
    if (!empty($priceFrom)) {
        $sql .= " AND price >= $priceFrom";
    }
    if (!empty($priceTo)) {
        $sql .= " AND price <= $priceTo";
    }
    if (isset($orderBy)) {
        $sql .= " ORDER BY $orderBy";
        if (isset($_GET["sortBy"])) {
            $sortBy = $_GET["sortBy"];
        }
        $sql .= " $sortBy";
    }
    echo $sql."<br>";
    $np = array();
    $np[":catId"] = $catId;
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($records);
    
    if (empty($_SESSION["scart"])) {
        foreach ($records as $record) {
            $newItem = array();
            $newItem["id"] = $record["playerId"];
            $newItem["catId"] = $record["catId"];
            $newItem["name"] = $record["playerName"];
            $newItem["image"] = $record["playerImage"];
            $newItem["price"] = $record["price"];
            array_push($_SESSION["scart"], $newItem);
            array_push($_SESSION["ids"], $record["playerId"]);
        }
    } else {
        $ids = array();
        foreach ($records as $record) {
            array_push($ids, $record["playerId"]);
        }
        
        $i = 0;
        foreach ($records as $record) {
            $newPlayer = array();
            $newPlayer["id"] = $record["playerId"];
            $newPlayer["catId"] = $record["catId"];
            $newPlayer["name"] = $record["playerName"];
            $newPlayer["image"] = $record["playerImage"];
            $newPlayer["price"] = $record["price"];
            if (!in_array($ids[$i], $_SESSION["ids"])) {
                array_push($_SESSION["scart"], $newPlayer);
                array_push($_SESSION["ids"], $ids[$i]);
            }
            $i++;
        }
    }
    
    // echo "<br><br>";
    // print_r($_SESSION["scart"]);
    // echo "<br><br>";
    // print_r($_SESSION["ids"]);
    // echo "<br><br>";
    // print_r($ids);
    $link = "index.php?catId=$catId&priceFrom=$priceFrom&submit=$submit";
    if (isset($_GET["orderBy"])) {
        $link .= "&orderBy=".$_GET["orderBy"];
    }
    if (isset($_GET["team"])) {
        $link .= "&team=".$_GET["team"];
    }
    if (isset($_GET["sortBy"])) {
        $link .= "&sortBy=".$_GET["sortBy"];
    }
    $link .= "&addAll=1";
    header("Location: ".$link);
?>